<?php

namespace common\models;

use yii\db\ActiveRecord;
use yii\validators\Validator;

/**
 * City model.
 *
 * @property integer $id
 * @property string $name
 * @property integer $region_id
 */
class City extends ActiveRecord
{
    /** {@inheritDoc} */
    public function rules()
    {
        return [
            [['region_id', 'name'], 'required'],
            ['region_id', 'exist', 'targetClass' => Region::class, 'targetAttribute' => 'id'],
            ['name', 'validateUniqueNameInRegion'],
        ];
    }

    /**
     * Validates city name: must be unique in region.
     *
     * @param string $attribute
     * @param array $params
     * @param Validator $validator
     */
    public function validateUniqueNameInRegion($attribute, $params, $validator)
    {
        if (
            $this->region_id === null ||
            City::findOne(['region_id' => $this->region_id, 'name' => $this->$attribute]) !== null
        ) {
            $this->addError(
                $attribute,
                sprintf('City with name "%s" already exists in region', $this->$attribute)
            );
        }
    }
}