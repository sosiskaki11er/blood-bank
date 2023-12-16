<?php

namespace App\Providers;

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\BloodBankController;
use App\Http\Controllers\Api\DonorController;
use App\SocketService;
use Http;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Route;
use URL;

class SocketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
            $socket = new SocketService();
            $socket->connect();

            // while (true) {
            //     $response = $socket->listen();

            //     if ($response){
            //         $controller = new DonorController();
            //         $controllerAdmin = $controller->index();

            //         $socket->write($controllerAdmin);
            //     }
            // }
    }
}
