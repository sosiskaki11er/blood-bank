const { rejects } = require('assert');
const { error } = require('console');
const net = require('net');
const { resolve } = require('path');
let decoder = new TextDecoder('utf-8');

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
      this.handleData(JSON.parse(decoder.decode(data).slice(7)));
    });

    this.client.on('close', () => {
      console.log('Connection closed');
    });
  }

  handleData() {
    // const [route, message] = data.split(':');
    // if (this.handlers[route]) {
    //   this.handlers[route](message);
    // } else {
    //   console.error(`No handler for route: ${route}`);
    // }

  }

  send(message) {
    //const message = `${route}:${data}`;
    //this.client.write(`${method}:${role}/${route}?${params}`);
    this.client.write(message)
  }


async request(type,role,route,params){
    return new Promise((resolve, reject) => {
      this.client.write(`${type}:${role}/${route}?${params}`)
      this.client.on('data', (data) => {
        resolve(JSON.parse(decoder.decode(data).slice(7)));
      });

      this.client.on('error',(error) => {
        reject(error)
      })
    })
  }
}

module.exports = TcpClient;