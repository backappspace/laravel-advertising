<?php

namespace Torondor\LaravelAdvertising\Facades;

use Illuminate\Support\Facades\Facade;
use Torondor\LaravelAdvertising\AdvertisingManager;

class Advertising extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return AdvertisingManager::class;
    }
}