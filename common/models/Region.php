<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Region model.
 *
 * @property integer $id
 * @property string $name
 * @property integer $country_id
 */
class Region extends ActiveRecord
{
    /** {@inheritDoc} */
    public function rules()
    {
        return [
            [['country_id', 'name'], 'required'],
            ['country_id', 'exist', 'targetClass' => Country::class, 'targetAttribute' => 'id']
        ];
    }
}