const net = require('net');
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

    this.client.on('close', () => {
      console.log('Connection closed');
    });
  }

  send(message) {
    //const message = `${route}:${data}`;
    //this.client.write(`${method}:${role}/${route}?${params}`);
    this.client.write(message)
  }


async request(type,role,route,params){
    return new Promise((resolve, reject) => {
      this.client.write(`${type}:${role}/${route}${params}`)
      this.client.on('data', (data) => {
        data = JSON.parse(decoder.decode(data).slice(7))
        console.log(data.status)
        if(data.status === 'error' || !data.status){
          reject()
        }
        resolve(data);
      });

      this.client.on('error',(error) => {
      })
    })
  }
}

module.exports = TcpClient;