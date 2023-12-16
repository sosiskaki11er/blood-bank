<?php

namespace App\Http\Api\Controllers;

use ElephantIO\Client as SocketClient;
use Illuminate\Http\Request;

class SocketController extends Controller
{
    public function sendMessage()
    {
        // Connect to the socket server
        $client = new SocketClient('http://127.0.0.1:8080');
        $client->initialize();

        // Send the message
        $client->emit('message', ['text' => 'b']);
        $client->close();

        return response();
    }
}
