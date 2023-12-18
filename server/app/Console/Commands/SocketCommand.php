<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\DonorController;
use App\SocketService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

use GuzzleHttp\Client;

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

                try
                {
                    //call the route with the path
                    $client = new Client(['base_uri' => 'http://127.0.0.1:8000']);
                    $response = $client->request($method, $path, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                } catch (\Exception $e) {
                    $content = 'front:'. $front_id . ':error';
                    $socket->write($content);
                    continue;
                }

                // $response = app()->handle($request);
                if ($response->getStatusCode() == 0) {
                    $content = 'front:'. $front_id . ':error';
                    $socket->write($content);
                }
                $content = 'front:'. $front_id . ':' . $response->getBody();

                echo $content;
                $socket->write($content);
            }
        }
    }
}
