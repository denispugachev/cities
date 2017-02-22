<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\validators\Validator;

/**
 * REST wrapper for City model.
 *
 * {@inheritDoc}
 */
class CityRest extends City
{
    /**
     * Override method for adding related fields.
     *
     * {@inheritDoc}
     */
    public function fields()
    {
        return array_merge(parent::fields(), [
            'region',
            'country' => function() {
                return $this->region->country;
            }
        ]);
    }
}