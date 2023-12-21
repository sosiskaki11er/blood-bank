<?php

namespace App;
use App\Http\Controllers\Api\BloodBankController;

class SocketService
{
    protected $socket;

    public function connect($host = '127.0.0.1', $port = 8080)
    {
        $this->socket = fsockopen($host, $port, $errno, $errstr, 10);

        $dataToSend = 'b';
        fwrite($this->socket, $dataToSend);

        return $this->socket;
    }

    public function close()
    {
        fclose($this->socket);
    }
    public function write($message)
    {
        fwrite($this->socket, $message);
    }

    public function listen()
    {
        $response = fread($this->socket, 1024);

        return $response;
    }
}
