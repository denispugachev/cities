<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Country model.
 *
 * @property integer $id
 * @property string $name
 */
class Country extends ActiveRecord
{
    /** {@inheritDoc} */
    public function rules()
    {
        return [
            ['name', 'required'],
        ];
    }
}