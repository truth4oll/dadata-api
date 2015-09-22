<?php

namespace truth4oll\dadata\Response;

use GuzzleHttp\Collection;

class CleanPassport extends Collection
{
    public function getSource()
    {
        return $this->get('source');
    }

    public function getSeries()
    {
        return $this->get('series');
    }

    public function getNumber()
    {
        return $this->get('number');
    }

    public function getQc()
    {
        return $this->get('qc');
    }
}