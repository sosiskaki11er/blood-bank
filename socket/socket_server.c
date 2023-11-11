#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <arpa/inet.h>
#include <pthread.h>

#define PORT 8080
#define MAX_CLIENTS 5

struct ClientInfo {
    char ip[INET_ADDRSTRLEN];
    int port;
    int client_socket;
    char client_type; // 'f' for front end, 'b' for back end
};

void *handle_client(void *arg);

pthread_mutex_t mutex = PTHREAD_MUTEX_INITIALIZER; // Declare the mutex
int b_user_socket = -1; // Global variable to store the back-end user socket
int f_user_socket = -1; // Global variable to store the front-end user socket

int main() {
    int server_fd;
    struct sockaddr_in address;
    int addrlen = sizeof(address);

    // Create a socket
    if ((server_fd = socket(AF_INET, SOCK_STREAM, 0)) == 0) {
        perror("Socket creation failed");
        exit(EXIT_FAILURE);
    }

    address.sin_family = AF_INET;
    address.sin_addr.s_addr = INADDR_ANY;
    address.sin_port = htons(PORT);

    // Bind the socket to the port
    if (bind(server_fd, (struct sockaddr *)&address, sizeof(address)) < 0) {
        perror("Binding failed");
        exit(EXIT_FAILURE);
    }

    // Listen for incoming connections
    if (listen(server_fd, 3) < 0) {
        perror("Listen failed");
        exit(EXIT_FAILURE);
    }

    printf("Server listening on port %d...\n", PORT);

    pthread_t threads[MAX_CLIENTS];
    struct ClientInfo client_info[MAX_CLIENTS]; // Use an array to store client information
    int thread_index = 0;

    while (1) {
        int new_socket;

        // Accept incoming connection
        if ((new_socket = accept(server_fd, (struct sockaddr *)&address, (socklen_t *)&addrlen)) < 0) {
            perror("Accept failed");
            exit(EXIT_FAILURE);
        }

        struct ClientInfo new_client;
        inet_ntop(AF_INET, &address.sin_addr, new_client.ip, INET_ADDRSTRLEN);
        new_client.port = ntohs(address.sin_port);
        new_client.client_socket = new_socket;

        // Receive the client type ('f' or 'b')
        char client_type;
        if (read(new_socket, &client_type, sizeof(client_type)) <= 0) {
            perror("Failed to receive client type");
            close(new_socket);
            continue;
        }
        new_client.client_type = client_type;

        printf("User connected from %s:%d as type %c.\n", new_client.ip, new_client.port, new_client.client_type);

        // Create a new thread for each client
        if (thread_index < MAX_CLIENTS) {
            client_info[thread_index] = new_client;
            if (pthread_create(&threads[thread_index], NULL, handle_client, &client_info[thread_index]) != 0) {
                perror("Thread creation failed");
            }
            thread_index++;

            if (new_client.client_type == 'b') {
                // If a back-end user connects, check if there's an existing back-end user
                pthread_mutex_lock(&mutex);
                if (b_user_socket != -1) {
                    // Disconnect the existing back-end user
                    close(b_user_socket);
                    b_user_socket = -1;
                }
                b_user_socket = new_client.client_socket;
                pthread_mutex_unlock(&mutex);
            } else if (new_client.client_type == 'f') {
                // If a front-end user connects, set the f_user_socket
                pthread_mutex_lock(&mutex);
                f_user_socket = new_client.client_socket;
                pthread_mutex_unlock(&mutex);
            }
        }
    }

    // The server will keep running and accepting new connections

    return 0;
}

void *handle_client(void *arg) {
    struct ClientInfo *client_info = (struct ClientInfo *)arg;
    int client_socket = client_info->client_socket;
    char buffer[1024] = {0};

    // Receive data from the client
    while (read(client_socket, buffer, 1024) > 0) {
        printf("Received from %s:%d (%c): %s\n", client_info->ip, client_info->port, client_info->client_type, buffer);

        // Forward messages from 'f' clients to corresponding 'b' clients
        if (client_info->client_type == 'f') {
            pthread_mutex_lock(&mutex);
            if (b_user_socket != -1) {
                // Forward the message to the back-end user in the expected format
                char formatted_message[1024];
                snprintf(formatted_message, sizeof(formatted_message), "front:%s", buffer);
                write(b_user_socket, formatted_message, strlen(formatted_message));
            }
            pthread_mutex_unlock(&mutex);
        } else if (client_info->client_type == 'b') {
            // Reply to the front end user in the expected format
            pthread_mutex_lock(&mutex);
            if (f_user_socket != -1) {
                write(f_user_socket, buffer, strlen(buffer));
            }
            pthread_mutex_unlock(&mutex);
        }

        memset(buffer, 0, sizeof(buffer));
    }

    printf("Client %s:%d (%c) disconnected.\n", client_info->ip, client_info->port, client_info->client_type);
    close(client_socket);

    if (client_info->client_type == 'b') {
        // If a back-end user disconnects, reset the b_user_socket
        pthread_mutex_lock(&mutex);
        if (b_user_socket == client_socket) {
            b_user_socket = -1;
        }
        pthread_mutex_unlock(&mutex);
    } else if (client_info->client_type == 'f') {
        // If a front-end user disconnects, reset the f_user_socket
        pthread_mutex_lock(&mutex);
        if (f_user_socket == client_socket) {
            f_user_socket = -1;
        }
        pthread_mutex_unlock(&mutex);
    }

    pthread_exit(NULL);
}
