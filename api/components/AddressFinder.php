<?php

namespace api\components;

use GuzzleHttp\Client;
use Yii;
use yii\base\Component;
use yii\base\Exception;

/**
 * Component for address searching and checking distance between points.
 */
class AddressFinder extends Component
{
    /**
     * Returns true if address point located not farther from coordinates.
     *
     * @param string $address
     * @param float $lat
     * @param float $lng
     * @param float $distance
     * @return bool
     */
    public function find($address, $lat, $lng, $distance)
    {
        $coordinates = Yii::$app->cache->getOrSet([__FUNCTION__, $address], function($cache) use ($address) {
            return $this->getAddressCoordinates($address);
        }, 3600);

        return $this->distance($lat, $lng, $coordinates[1], $coordinates[0]) <= $distance;
    }

    /**
     * Returns address point coordinates in format: [longitude, latitude]. If coordinates not found - throws exception.
     *
     * @param string $address
     * @return array
     * @throws Exception
     */
    protected function getAddressCoordinates($address)
    {
        $client = new Client([
            'base_uri' => 'https://geocode-maps.yandex.ru/1.x/',
            'timeout' => 10,
        ]);

        $response = $client->request('GET', '', [
            'query' => [
                'geocode' => $address,
                'format' => 'json',
                'results' => 1,
            ]
        ]);

        $json = json_decode($response->getBody(), true);
        if (
            isset($json['response']) &&
            isset($json['response']['GeoObjectCollection']) &&
            count($json['response']['GeoObjectCollection']['featureMember']) > 0
        ) {
            $point = explode(' ', $json['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']);

            return array_map(function ($value) {
                return (float)$value;
            }, $point);
        }

        throw new Exception('Address not found in Yandex.Geocoder');
    }

    /**
     * Returns distance from coordinates in kilometers.
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    protected function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        return $dist * 60 * 1.1515 * 1.609344;
    }
}