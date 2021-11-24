<?php

namespace App\Providers;

use App\Services\Tweet\TweetService;
use App\Services\Tweet\TweetServiceInterface;
use GuzzleHttp\Client;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TweetServiceInterface::class,
            function (Application $app, $params = []) {
                $client = new Client(
                    $app['config']->get('services.tweet.http-client-options')
                );

                return new TweetService($client);
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
