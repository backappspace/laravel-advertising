<?php

namespace Torondor\LaravelAdvertising\Drivers;

/**
 * Interface DriverInterface
 * @package App\Exceptions\AdvertisingExtension\Drivers
 */
interface DriverInterface
{
    /**
     * @param $globalKey
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($globalKey, $key, $value);

    /**
     * @param $globalKey
     * @param $key
     * @return mixed
     */
    public function get($globalKey, $key);

    /**
     * @param $globalKey
     * @param $key
     * @return mixed
     */
    public function delete($globalKey, $key);
}