import { createRoot } from 'react-dom/client';
import App from './App';
import TcpClient from './TcpClient';

// Replace with the server's host and port
const HOST = '192.168.70.191';
const PORT = 8080;

export const Socket = new TcpClient(HOST,PORT)
Socket.connect()
Socket.send("f")
const container = document.getElementById('root') as HTMLElement;
const root = createRoot(container);
root.render(<App />);



