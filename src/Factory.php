<?php

namespace truth4oll\dadata;

use GuzzleHttp\Collection;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;
use GuzzleHttp\Command\Guzzle\Serializer;
use truth4oll\dadata\RequestLocation\JsonBodyLocation;
use truth4oll\dadata\Subscriber\Authorization;

class Factory
{
    protected $description;



    public function createClient(array $config)
    {
        return new Client($this->createGuzzleClient($config));
    }


}