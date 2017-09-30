<?php

namespace Gonzaloner\LaravelTrustSpot;

use Illuminate\Contracts\Container\Container;

/**
 * Class TrustSpotManager.
 */
class LaravelTrustSpotManager
{
    /**
     * @var Container
     */
    protected $app;

    /**
     * TrustSpotManager constructor.
     *
     * @param Container $app
     *
     * @return void
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    /**
     * @return mixed
     */
    public function api()
    {
        return $this->app['laraveltrustspot.api'];
    }
}
