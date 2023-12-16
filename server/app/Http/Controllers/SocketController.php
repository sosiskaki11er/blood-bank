<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocketService;

class SocketController extends Controller
{
    public function sendMessage(Request $request, SocketService $socketService)
    {
        try {
            $userType = 'b';
            $response = $socketService->sendMessageToCServer($userType);

            dd($response);
            return response()->json(['response' => $response]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function receiveMessage(Request $request, SocketService $socketService)
{
    $userType = 'b';
    $response = $socketService->sendMessageToCServer($userType);

//     $host = '127.0.0.1';  // Replace with your C server's IP address
//     $port = 8080;          // Replace with your C server's port

//     try {
//         $socket = fsockopen($host, $port, $errno, $errstr, 10);
//         if (!$socket) {
//             throw new \Exception('Unable to create socket');
//         }

//         // $buffer = '';
//         // $data = fread($socket, 1024);
//         // dd($data);
//         // while (!feof($socket)) {
//         //     $data = fread($socket, 1024);
//         //     if (!$data) {
//         //         throw new \Exception('Error reading from socket');
//         //     }
//         //     $buffer .= $data;
//         // }

//         // $message = json_decode($buffer, true);
//         // if ($message !== null) {
//         //     echo 'Received message: ' . $message['text'] . PHP_EOL;
//         // } else {
//         //     echo 'Error decoding message.' . PHP_EOL;
//         // }

//         fclose($socket);
//     } catch (\Exception $e) {
//         echo 'Error: ' . $e->getMessage() . PHP_EOL;
//     }
}

    public function connect(Request $request, SocketService $socketService)
    {
            $socket = $socketService->connect();

            return response()->json(['response' => 'Connected to socket server']);
    }

    public function close(Request $request, SocketService $socketService)
    {
        $socketService->close();

        return response()->json(['response' => 'Socket connection closed']);
    }
}
