<?php

namespace common\models;

use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\validators\Validator;

/**
 * City model.
 *
 * @property integer $id
 * @property string $name
 * @property integer $region_id
 * @property Region $region
 */
class City extends ActiveRecord
{
    /** {@inheritDoc} */
    public static function tableName()
    {
        return 'city';
    }

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
        if ($this->region_id !== null) {
            $city = City::findOne(['region_id' => $this->region_id, 'name' => $this->$attribute]);

            if ($city !== null && ($city->id != $this->id)) {
                $this->addError(
                    $attribute,
                    sprintf('City with name "%s" already exists in region', $this->$attribute)
                );
            }
        }
    }

    /** {@inheritDoc} */
    public function attributeLabels()
    {
        return [
            'region_id' => 'Region',
            'region.name' => 'Region',
            'region.country.name' => 'Country',
        ];
    }

    /**
     * Returns Region relation.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion() {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }

    /**
     * Returns ActiveDataProvider for model.
     *
     * @return ActiveDataProvider
     */
    public static function getActiveDataProvider()
    {
        return new ActiveDataProvider([
            'query' => City::find()->with('region', 'region.country')->orderBy('city.id'),
            'pagination' => false,
            'sort' => false,
        ]);
    }
}