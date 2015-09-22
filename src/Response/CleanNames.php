<?php

namespace truth4oll\dadata\Response;

use GuzzleHttp\Collection;

class CleanNames extends Collection
{
    public function __construct(array $data)
    {
        foreach ($data as $key => & $name) {
            $name = new CleanName($name);
        }
        parent::__construct($data);
    }
}