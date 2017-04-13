<?php

namespace Torondor\LaravelAdvertising;

use Torondor\LaravelAdvertising\Drivers\RedisDriver;
use Torondor\LaravelAdvertising\Repositories\BannersRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class AdvertisingServiceProvider
 * @package Iconx\Advertising
 */
class AdvertisingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // migrations
        $this->publishes([
            __DIR__ . '/resources/migrations/' => database_path('migrations')
        ], 'migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
        $this->registerDrivers();

        $this->app->bind(Advertising::class, function () {
            return new Advertising(
                $this->app->make(RedisDriver::class),
                $this->app->make(BannersRepository::class),
                $this->app->make('config')
            );
        });
    }

    /**
     * Register drivers
     */
    private function registerDrivers()
    {
        $this->app->bind(RedisDriver::class, function () {
            return new RedisDriver(
                $this->app->make('redis')
            );
        });
    }

    /**
     * Register repositories
     */
    private function registerRepositories()
    {
        $this->app->bind(BannersRepository::class, function () {
            $banner = env('ADVERTISEMENT_BANNER_MODEL', App\Banner::class);
            return new BannersRepository(
                new $banner
            );
        });
    }
}