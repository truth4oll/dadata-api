<?php

namespace truth4oll\dadata\Response;

use GuzzleHttp\Collection;

class CleanEmails extends Collection
{
    public function __construct(array $data)
    {
        foreach ($data as $key => & $email) {
            $email = new CleanEmail($email);
        }
        parent::__construct($data);
    }
}