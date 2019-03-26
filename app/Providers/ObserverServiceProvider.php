<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Client;
use App\Product;
use App\Observers\UserActionsObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Client::observe( new UserActionsObserver );
        Product::observe( new UserActionsObserver );
    }

    public function register()
    {
    }
}