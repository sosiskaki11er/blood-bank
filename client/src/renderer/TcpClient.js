const net = require('net');

class TcpClient {
  constructor(host, port, handlers) {
    this.client = new net.Socket();
    this.host = host;
    this.port = port;
    this.handlers = handlers;  // Object containing handlers for different routes
  }

  connect() {
    this.client.connect(this.port, this.host, () => {
      console.log('Connected to server');
    });

    this.client.on('data', (data) => {
      this.handleData(data.toString());
    });

    this.client.on('close', () => {
      console.log('Connection closed');
    });
  }

  handleData(data) {
    const [route, message] = data.split(':');
    if (this.handlers[route]) {
      this.handlers[route](message);
    } else {
      console.error(`No handler for route: ${route}`);
    }
  }

  send(message) {
    //const message = `${route}:${data}`;
    this.client.write(message);
  }
}

module.exports = TcpClient;