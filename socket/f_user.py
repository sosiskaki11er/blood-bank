import socket
import sys

HOST = '127.0.0.1'
PORT = 8080

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.connect((HOST, PORT))
    s.sendall(b'f')  # Send the client type 'f' for front end

    while True:
        sys.stdout.write("Enter a message to send to the server: ")
        sys.stdout.flush()  # Force the output to be displayed immediately

        message = input()
        s.sendall(message.encode())

        data = s.recv(1024)
        if not data:
            break

        decoded_data = data.decode()
        print(f"Received from back end user: {decoded_data}")

