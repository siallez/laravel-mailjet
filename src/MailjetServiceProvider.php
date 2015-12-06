<?php

namespace Siallez\Mailjet;

use Illuminate\Support\ServiceProvider;

class MailjetServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/mailjet.php', 'mailjet');
        
        $this->app->bind('\Mailjet\Client', function ($app) {
            return new \Mailjet\Client($app['config']['mailjet.apikey_public'], $app['config']['mailjet.apikey_private']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['\Mailjet\Client'];
    }
}
