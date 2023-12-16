<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\DonorController;
use App\SocketService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class SocketCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socket:connect';
    protected $description = 'Connecting to the socket service';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $socket = new SocketService();
        $socket->connect();

        while (true) {
            $response = $socket->listen();

            if ($response){

                $responseParts = explode(':', $response);
                $front_id = $responseParts[1];
                $method = $responseParts[2];
                $pathParts = $responseParts[3];
                if (count($responseParts) == 5) {
                    $token = $responseParts[4];
                }
                $path = '/api/' . $pathParts;

                //call the route with the path
                $request = Request::create($path, $method);
                $request->headers->set('Accept', 'application/json');
                if (count($responseParts) == 5) {
                    $request->headers->set('Authorization', 'Bearer ' . $token);
                }
                $response = app()->handle($request);
                if ($response->getStatusCode() == 0) {
                    $content = 'front:'. $front_id . ':error';
                    $socket->write($content);
                }
                $content = 'front:'. $front_id . ':' . $response->getContent();

                echo $content;
                $socket->write($content);
            }
        }
    }
}
