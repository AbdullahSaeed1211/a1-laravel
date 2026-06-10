<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MongoDB\Laravel\MongoDBServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        if (env('MONGODB_URI') && extension_loaded('mongodb')) {
            $this->app->register(MongoDBServiceProvider::class);
        }
    }

    public function boot(): void
    {
        if (! env('MONGODB_URI') || ! extension_loaded('mongodb')) {
            config(['database.default' => 'sqlite']);
        }
    }
}
