<?php

namespace truth4oll\dadata\Response;

use GuzzleHttp\Collection;

class CleanPassports extends Collection
{
    public function __construct(array $data)
    {
        foreach ($data as $key => & $passport) {
            $passport = new CleanPassport($passport);
        }
        parent::__construct($data);
    }
}