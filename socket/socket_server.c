#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <pthread.h>

#define PORT 8080
#define MAX_CLIENTS 20
#define BUFFER_SIZE 10240

struct ClientInfo
{
    char ip[INET_ADDRSTRLEN];
    int port;
    int client_socket;
    char client_type; // 'f' for front end, 'b' for back end
};

struct FrontEndUser
{
    int client_socket;
    pthread_t thread;
};

pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER;
int b_user_socket = -1;
struct FrontEndUser f_users[MAX_CLIENTS];
int thread_index = 0; // Declare thread_index as a global variable

void *handle_client(void *arg);
void *handle_front_end_user(void *arg);

int main()
{
    int server_fd;
    struct sockaddr_in address;
    int addrlen = sizeof(address);

    // Create a socket
    if ((server_fd = socket(AF_INET, SOCK_STREAM, 0)) == 0)
    {
        perror("Socket creation failed");
        exit(EXIT_FAILURE);
    }

    address.sin_family = AF_INET;
    address.sin_addr.s_addr = INADDR_ANY;
    address.sin_port = htons(PORT);

    // Enable SO_REUSEADDR option to allow reusing the address
    int reuse_addr = 1;
    if (setsockopt(server_fd, SOL_SOCKET, SO_REUSEADDR, &reuse_addr, sizeof(reuse_addr)) < 0)
    {
        perror("Setsockopt failed");
        exit(EXIT_FAILURE);
    }

    // Bind the socket to the port
    if (bind(server_fd, (struct sockaddr *)&address, sizeof(address)) < 0)
    {
        perror("Binding failed");

        // Attempt to bind again
        if (bind(server_fd, (struct sockaddr *)&address, sizeof(address)) < 0)
        {
            perror("Second binding attempt failed");
            exit(EXIT_FAILURE);
        }
    }

    // Listen for incoming connections
    if (listen(server_fd, 10) < 0)
    {
        perror("Listen failed");
        exit(EXIT_FAILURE);
    }

    printf("Server listening on port %d...\n", PORT);

    pthread_t threads[MAX_CLIENTS];
    struct ClientInfo client_info[MAX_CLIENTS];

    while (1)
    {
        int new_socket;

        // Accept incoming connection
        if ((new_socket = accept(server_fd, (struct sockaddr *)&address, (socklen_t *)&addrlen)) < 0)
        {
            perror("Accept failed");
            exit(EXIT_FAILURE);
        }

        struct ClientInfo new_client;
        inet_ntop(AF_INET, &address.sin_addr, new_client.ip, INET_ADDRSTRLEN);
        new_client.port = ntohs(address.sin_port);
        new_client.client_socket = new_socket;

        // Receive the client type ('f' or 'b')
        char client_type;
        if (read(new_socket, &client_type, sizeof(client_type)) <= 0)
        {
            perror("Failed to receive client type");
            close(new_socket);
            continue;
        }
        new_client.client_type = client_type;

        printf("User connected from %s:%d as type %c.\n", new_client.ip, new_client.port, new_client.client_type);

        // Check if a back-end user or front-end user is already connected
        if ((new_client.client_type == 'b' && b_user_socket != -1) ||
            (new_client.client_type == 'f' && thread_index >= MAX_CLIENTS))
        {
            printf("Another user tried to connect. Rejecting the connection.\n");
            close(new_socket);
            continue;
        }

        // Create a new thread for each client
        if (thread_index < MAX_CLIENTS)
        {
            client_info[thread_index] = new_client;
            if (new_client.client_type == 'f')
            {
                // If a front-end user connects, handle communication in a separate thread
                f_users[thread_index].client_socket = new_socket;
                if (pthread_create(&f_users[thread_index].thread, NULL, handle_front_end_user, &f_users[thread_index]) != 0)
                {
                    perror("Thread creation failed");
                }
            }
            else
            {
                // If a back-end user connects, handle communication in the main thread
                b_user_socket = new_client.client_socket;
                if (pthread_create(&threads[thread_index], NULL, handle_client, &client_info[thread_index]) != 0)
                {
                    perror("Thread creation failed");
                }
            }
            thread_index++;
        }
    }

    return 0;
}

// Rest of the code remains unchanged...
void *handle_client(void *arg)
{
    struct ClientInfo *client_info = (struct ClientInfo *)arg;
    int client_socket = client_info->client_socket;
    char buffer[BUFFER_SIZE] = {0};
    // Receive data from the client
    while (read(client_socket, buffer, BUFFER_SIZE) > 0)
    {
        printf("Received from %s:%d (%c): %s\n", client_info->ip, client_info->port, client_info->client_type, buffer);
        pthread_mutex_lock(&mutex);
        if (client_info->client_type == 'f')
        {
            // Forward messages from front-end user to the connected back-end user
            if (b_user_socket != -1)
            {
                // Include the socket file descriptor of the front-end user in the message
                char formatted_message[BUFFER_SIZE];
                snprintf(formatted_message, sizeof(formatted_message), "front:%d:%s", client_socket, buffer);
                write(b_user_socket, formatted_message, strlen(formatted_message));
                printf("Forwarded to back end user (socket %d): %s\n", client_socket, formatted_message);
            }
        }
        else if (client_info->client_type == 'b')
        {
            // Check if the message starts with "back:" and extract the front-end socket ID and message
            int front_socket;
            int responce_for_error =0;
            char *message_start = strstr(buffer, "front:");
            if (message_start != NULL && sscanf(message_start, "front:%d:%[^\n]", &front_socket, buffer) == 2)
            {
                // Reply to the specific front-end user in the expected format
                char formatted_message[BUFFER_SIZE];
                if (front_socket > 9)
                {
                    snprintf(formatted_message, sizeof(formatted_message), "back:%d:%s", responce_for_error, buffer);
                    write(front_socket, formatted_message, strlen(formatted_message));
                    printf("Replied to front end user (socket %d): %s\n", front_socket, formatted_message);
                }
                else {
                    snprintf(formatted_message, sizeof(formatted_message), "back:%d:%s", front_socket, buffer);
                    write(front_socket, formatted_message, strlen(formatted_message));
                    printf("Replied to front end user (socket %d): %s\n", front_socket, formatted_message);}
            }
        }
        pthread_mutex_unlock(&mutex);
        memset(buffer, 0, sizeof(buffer));
    }

    printf("Client %s:%d (%c) disconnected.\n", client_info->ip, client_info->port, client_info->client_type);
    close(client_socket);

    // Update the global socket variable when a client disconnects
    pthread_mutex_lock(&mutex);

    if (client_info->client_type == 'b' && b_user_socket == client_socket)
    {
        b_user_socket = -1;
    }

    pthread_mutex_unlock(&mutex);

    pthread_exit(NULL);
}

void *handle_front_end_user(void *arg)
{
    struct FrontEndUser *f_user = (struct FrontEndUser *)arg;
    int client_socket = f_user->client_socket;
    char buffer[BUFFER_SIZE] = {0};

    // Receive data from the front-end user
    while (read(client_socket, buffer, BUFFER_SIZE) > 0)
    {
        printf("Received from front end user (socket %d): %s\n", client_socket, buffer);

        // Forward messages from the front end user to the back end
        pthread_mutex_lock(&mutex);
        if (b_user_socket != -1)
        {
            // Forward the message to the back-end user in the expected format
            char formatted_message[BUFFER_SIZE];
            snprintf(formatted_message, sizeof(formatted_message), "front:%d:%s", client_socket, buffer);
            printf("Forwarding to back end user: %s\n", formatted_message);
            write(b_user_socket, formatted_message, strlen(formatted_message));
        }
        pthread_mutex_unlock(&mutex);

        memset(buffer, 0, sizeof(buffer));
    }

    printf("Front end user (socket %d) disconnected.\n", client_socket);
    close(client_socket);

    // Update the global socket variable when a front-end user disconnects
    pthread_mutex_lock(&mutex);
    for (int i = 0; i < MAX_CLIENTS; ++i)
    {
        if (f_users[i].client_socket == client_socket)
        {
            // Remove the disconnected front-end user
            f_users[i].client_socket = -1;

            // Decrement the thread_index
            if (thread_index > 0)
            {
                thread_index--;
            }
            break;
        }
    }
    pthread_mutex_unlock(&mutex);

    pthread_exit(NULL);
}
