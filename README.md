# laravel-advertising
Package to show banners in laravel project easilly

Installation:

1) Add

    "require": {
        "torondor/laravel-advertising": "0.1.0"
    },
    
to your composer.json
    
2) Add Torondor\LaravelAdvertising\AdvertisingServiceProvider::class to config/app.php

3) php artisan migrate --path="/vendor/torondor/laravel-advertising/src/resources/migrations" to make migrations

To customize the migration, publish it with the following command:

php artisan vendor:publish --provider="Torondor\LaravelAdvertising\AdvertisingServiceProvider" --tag="migrations"

You can use you existent model by set it's name in ADVERTISEMENT_BANNER_MODEL in .env and your banners table must contain 
'position'  column

4) php artisan vendor:publish --provider="Torondor\LaravelAdvertising\AdvertisingServiceProvider" --tag="config"

Publish config file and add your keys to it. For example: 'banners' => [ 'under_menu' => 1, 'sidebar' => 2, 'over_footer' => 3, 'over_comments' => 4 ]

In this case position column in database must have value 1, 2, 3 or 4
