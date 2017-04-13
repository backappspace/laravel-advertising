<?php

namespace Torondor\LaravelAdvertising;

use Torondor\LaravelAdvertising\Drivers\DriverInterface;
use Torondor\LaravelAdvertising\Repositories\BannersRepository;
use Illuminate\Config\Repository AS Config;

/**
 * Class Advertising
 * @package App\Exceptions\AdvertisingExtension
 */
class Advertising
{
    /**
     * @var DriverInterface
     */
    private $driver;

    /**
     * @var BannersRepository
     */
    private $banners;

    /**
     * @var Config
     */
    private $config;

    /**
     * @param DriverInterface $driver
     * @param BannersRepository $banners
     * @param Config $config
     */
    public function __construct(DriverInterface $driver, BannersRepository $banners, Config $config)
    {
        $this->driver = $driver;
        $this->banners = $banners;
        $this->config = $config;
    }

    /**
     * @param $key
     * @param $position
     * @return mixed
     */
    public function getBanner($key, $position)
    {
        $bannerKey  = array_search($position, $this->config->get('constants.banners'));
        $seen       = ($data = $this->driver->get($key, $bannerKey)) ? (json_decode($data)) : [];
        $banner     = $this->banners->search($position, [], ['seen' => $seen, 'first' => true])->first();

        if (empty($banner)) {
            $this->driver->delete($key, $bannerKey);
            $seen = [];
            $banner = $this->banners->search($position);
        }

        if (!empty($banner)) {
            $seen[] = $banner->id;
            $this->driver->set($key, $bannerKey, json_encode($seen));
        }

        return $banner;
    }
}