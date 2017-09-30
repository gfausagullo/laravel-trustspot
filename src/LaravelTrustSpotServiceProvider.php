<?php

namespace Gonzaloner\LaravelTrustSpot;

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application as LaravelApplication;
use Laravel\Lumen\Application as LumenApplication;
use Gonzaloner\LaravelTrustSpot\Wrappers\TrustSpotApiWrapper;
use Gonzaloner\TrustSpotApiClient\TrustSpotApiClient;

class LaravelTrustSpotServiceProvider extends ServiceProvider
{

  public function boot()
  {
    $this->setupConfig();
  }

  public function register()
  {
    $this->registerApiClient();
    $this->registerApiWrapper();
  }

  protected function setupConfig()
  {
    $source = realpath(__DIR__ . '/../config/laraveltrustspot.php');

    if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
      $this->publishes([$source => config_path('laraveltrustspot.php')]);
    } elseif ($this->app instanceof LumenApplication) {
      $this->app->configure('laraveltrustspot');
    }

    $this->mergeConfigFrom($source, 'laraveltrustspot');
  }

  protected function registerApiClient()
  {
    $this->app->singleton('laraveltrustspot.client', function () {
      return new TrustSpotApiClient();
    });
    $this->app->alias('laraveltrustspot.client', TrustSpotApiClient::class);
  }

  protected function registerApiWrapper()
  {
    $this->app->singleton('laraveltrustspot', function (Container $app) {
      $config = $app['config'];
      return new TrustSpotApiWrapper($config, $app['laraveltrustspot.client']);
    });
    $this->app->alias('laraveltrustspot', TrustSpotApiWrapper::class);
  }


  public function provides()
  {
    return [
      'laraveltrustspot',
      'laraveltrustspot.client',
    ];
  }

}
