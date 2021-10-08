<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(\Packages\Services\TokenManagerServiceInterface::class, function (Application $app) {
            $config = \Lcobucci\JWT\Configuration::forSymmetricSigner(
                new \Lcobucci\JWT\Signer\Hmac\Sha512(),
                \Lcobucci\JWT\Signer\Key\InMemory::base64Encoded($app['config']->get('jwt')['secret'])
            );
            return new \Packages\Services\JwtTokenManagerService($config);
        });
    }
}
