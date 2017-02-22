<?php

namespace api\models;

use api\components\AddressFinder;
use Yii;
use yii\base\Model;

/**
 * Address search request model.
 */
class AddressSearchRequest extends Model
{
    /**
     * @var string Address
     */
    public $address;

    /**
     * @var float Latitude
     */
    public $lat;

    /**
     * @var float Longitude
     */
    public $lng;

    /**
     * @var float Distance
     */
    public $distance;

    /** {@inheritDoc} */
    public function rules()
    {
        return [
            [['address', 'lat', 'lng', 'distance'], 'required'],
        ];
    }

    /**
     * Executes the find method and returns result.
     *
     * @return bool
     */
    public function execute()
    {
        /** @var AddressFinder $addressFinder */
        $addressFinder = Yii::$app->addressFinder;

        return $addressFinder->find(
            (string)$this->address,
            (float)$this->lat,
            (float)$this->lng,
            (float)$this->distance
        );
    }
}