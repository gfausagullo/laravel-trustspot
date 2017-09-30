<?php

namespace Gonzaloner\LaravelTrustSpot\Wrappers;

use Illuminate\Contracts\Config\Repository;
use Gonzaloner\TrustSpotApiClient\TrustSpotApiClient;

class TrustSpotApiWrapper
{
  protected $config;
  protected $client;

  public function __construct(Repository $config, TrustSpotApiClient $client)
  {
    $this->config = $config;
    $this->client = $client;

    if ($this->config->has('laraveltrustspot.keys.auth')) {
      $this->setAuthKey($this->config->get('laraveltrustspot.keys.auth'));
    }
  }

  public function setAuthKey($api_key)
  {
    $this->client->setAuthKey($api_key);
  }

  public function getCompanyReviews($limit = NULL, $offset = NULL, $sort = NULL)
  {
    return $this->client->getCompanyReviews($limit, $offset, $sort);
  }
}
