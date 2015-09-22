<?php

namespace Truth4oll\Dadata;


use Truth4oll\Dadata\Response\CleanAddress;
use yii\httpclient\Client;
use yii\httpclient\JsonFormatter;
use yii\httpclient\JsonParser;
use yii\httpclient\UrlEncodedFormatter;
use yii\web\BadRequestHttpException;

class RestClient
{
    /** @var GuzzleClient */
    public static $lastRequestHeaders;

    public static $baseUrl = 'https://dadata.ru/api/v2/';

    public static $token = 'cb1096db1e64dcdfddce4e060d200653c5021dac';


    /**
     * @param string $address
     * @return CleanAddress
     */
    public static function suggestAddress($address)
    {
        $data = self::query('suggest/address', ['query' => $address]);
        return  new CleanAddress($data['suggestions'][0]['data']);
    }



    /**
     * @param string $address
     * @return CleanAddress
     */
    public function cleanAddress($address)
    {
        return $this->cleanAddresses([$address])->get(0);
    }

    /**
     * @param string[] $addresses
     * @return CleanAddresses
     */
    public function cleanAddresses(array $addresses)
    {
        return new CleanAddresses($this->guzzle->cleanAddress([
            'body' => $addresses
        ]));
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
        $client = new Client(['baseUrl' => self::$baseUrl]);
        $response = $client->post($url, $data, [
            'Authorization' => 'Token 1d06237cf740861ef28bcfd9fa3994097c1b50b5',
            'X-Secret' => self::$token
        ])->setFormat(Client::FORMAT_JSON)->send();
        if ($response->isOk) {
            return $response->data;
        }
        return false;
    }
}