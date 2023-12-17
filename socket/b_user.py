import socket

HOST = '127.0.0.1'
PORT = 8080

with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
    s.connect((HOST, PORT))
    s.sendall(b'b')  # Send the client type 'b' for back-end

    while True:
        data = s.recv(1024)
        if not data:
            break

        decoded_data = data.decode()
        
        # Check if ":" is present in the received data
        if ':' in decoded_data:
            _, message = decoded_data.split(':', 1)
            print(f"Received from front end user: {message}")
        else:
            print(f"Invalid data format: {decoded_data}")

        # Send a reply to the front end user
        reply = f'back : {message}'
        s.sendall(reply.encode())

