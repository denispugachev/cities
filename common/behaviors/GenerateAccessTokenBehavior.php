<?php

namespace common\behaviors;

use common\models\User;
use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

class GenerateAccessTokenBehavior extends Behavior
{
    /** {@inheritDoc} */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'generateAccessToken'
        ];
    }

    /**
     * Generates access token for user and sets it to attribute.
     *
     * @return bool
     */
    public function generateAccessToken()
    {
        /** @var User $owner */
        $owner = $this->owner;
        $owner->access_token = Yii::$app->security->generateRandomString();

        return true;
    }
}