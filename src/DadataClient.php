<?php

namespace truth4oll\dadata;


use truth4oll\dadata\Response\CleanAddress;
use truth4oll\dadata\Response\CleanName;
use yii\httpclient\Client;

class DadataClient
{

    public $baseUrl = 'https://dadata.ru/api/v2/';

    public $token;
    public $secret;

    /**
     * @param $options
     * @throws HttpException
     */
    public function __construct($options)
    {
        $this->token = ($options['token']) ? $options['token'] : null;
        $this->secret = ($options['secret']) ? $options['secret'] : null;
    }


    /**
     * @param string $address
     * @return CleanAddress
     */
    public function suggestAddress($address)
    {
        $data = $this->query('suggest/address', ['query' => $address]);
        if (isset($data['suggestions'][0])) {
            return new CleanAddress($data['suggestions'][0]['data']);
        }
        return false;
    }

    /**
     * @param string $address
     * @return CleanAddress
     */
    public function suggestFias($fias)
    {
        $data = $this->query('findById/address', ['query' => $fias]);
        if (isset($data['suggestions'][0])) {
            return new CleanAddress($data['suggestions'][0]['data']);
        }
        return false;
    }

    /**
     * @param $name
     * @return null|CleanName
     */
    public function suggestName($name)
    {
        $data = $this->query('suggest/fio', ['query' => $name]);
        if (count($data['suggestions']) > 0) {
            return new CleanName($data['suggestions'][0]['data']);
        }
        return null;
    }


    /**
     * @param string $address
     * @return CleanAddress
     */
    public function cleanAddress($address)
    {
        return $this->cleanAddresses([$address]);
    }

    /**
     * @param string[] $addresses
     * @return CleanAddresses
     */
    public function cleanAddresses(array $addresses)
    {
        $data = $this->query($this->baseUrl . 'clean/address', $addresses);
        if (count($data) > 0) {
            return new CleanAddress($data[0]);
        }
        return null;
    }

    /**
     * @param string $phone
     * @return CleanPhone
     */
    public function cleanPhone($phone)
    {
        return $this->cleanPhones([$phone])->get(0);
    }

    /**
     * @param string[] $phones
     * @return CleanPhones
     */
    public function cleanPhones(array $phones)
    {
        return new CleanPhones($this->guzzle->cleanPhone([
            'body' => $phones
        ]));
    }

    /**
     * @param string $passport
     * @return CleanPassport
     */
    public function cleanPassport($passport)
    {
        return $this->cleanPassports([$passport])->get(0);
    }

    /**
     * @param string[] $passports
     * @return CleanPassports
     */
    public function cleanPassports(array $passports)
    {
        return new CleanPassports($this->guzzle->cleanPassport([
            'body' => $passports
        ]));
    }

    /**
     * @param string $name
     * @return CleanName
     */
    public function cleanName($name)
    {
        return $this->cleanNames([$name])->get(0);
    }

    /**
     * @param string[] $names
     * @return CleanNames
     */
    public function cleanNames(array $names)
    {
        return new CleanNames($this->guzzle->cleanName([
            'body' => $names
        ]));
    }

    /**
     * @param string $email
     * @return CleanEmail
     */
    public function cleanEmail($email)
    {
        return $this->cleanEmails([$email])->get(0);
    }

    /**
     * @param string[] $emails
     * @return CleanEmails
     */
    public function cleanEmails(array $emails)
    {
        return new CleanEmails($this->guzzle->cleanEmail([
            'body' => $emails
        ]));
    }

    /**
     * @param string $date
     * @return CleanDate
     */
    public function cleanDate($date)
    {
        return $this->cleanDates([$date])->get(0);
    }

    /**
     * @param string[] $dates
     * @return CleanDates
     */
    public function cleanDates(array $dates)
    {
        return new CleanDates($this->guzzle->cleanDate([
            'body' => $dates
        ]));
    }

    /**
     * @param string $vehicle
     * @return CleanVehicle
     */
    public function cleanVehicle($vehicle)
    {
        return $this->cleanVehicles([$vehicle])->get(0);
    }

    /**
     * @param string[] $vehicles
     * @return CleanVehicles
     */
    public function cleanVehicles(array $vehicles)
    {
        return new CleanVehicles($this->guzzle->cleanVehicle([
            'body' => $vehicles
        ]));
    }


    public function query($url, $data)
    {
        $client = new Client(['baseUrl' => $this->baseUrl]);

        $response = $client->post($url, $data, [
            'Authorization' => 'Token ' . $this->token,
            'X-Secret' => $this->secret
        ])->setFormat(Client::FORMAT_JSON)->send();
        if ($response->isOk) {
            return $response->data;
        } else {
            print_r($response);
        }
        return false;
    }
}