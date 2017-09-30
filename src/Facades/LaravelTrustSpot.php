<?php

namespace Gonzaloner\LaravelTrustSpot\Facades;

use Illuminate\Support\Facades\Facade;
use Gonzaloner\LaravelTrustSpot\Wrappers\TrustSpotApiWrapper;

class LaravelTrustSpot extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laraveltrustspot';
    }
}
