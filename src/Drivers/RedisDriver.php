<?php

namespace Torondor\LaravelAdvertising\Drivers;

use Illuminate\Redis\RedisManager;

/**
 * Class RedisDriver
 * @package App\Exceptions\AdvertisingExtension\Drivers
 */
class RedisDriver implements DriverInterface
{
    /**
     * @var RedisManager
     */
    private $redis;

    /**
     * @param RedisManager $redis
     */
    public function __construct(RedisManager $redis)
    {
        $this->redis = $redis;
    }

    /**
     * @param $globalKey
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($globalKey, $key, $value)
    {
        $this->redis->hset($globalKey, $key, $value);
    }

    /**
     * @param $globalKey
     * @param $key
     * @return mixed
     */
    public function get($globalKey, $key)
    {
        return $this->redis->hget($globalKey, $key);
    }

    /**
     * @param $globalKey
     * @param $key
     * @return mixed
     */
    public function delete($globalKey, $key)
    {
        $this->redis->hdel($globalKey, $key);
    }
}