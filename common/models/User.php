<?php
namespace common\models;

use common\behaviors\GenerateAccessTokenBehavior;
use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model.
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $access_token
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    /** {@inheritDoc} */
    public function behaviors()
    {
        return [
            GenerateAccessTokenBehavior::class,
        ];
    }

    /** {@inheritDoc} */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /** {@inheritDoc} */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username.
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /** {@inheritDoc} */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /** {@inheritDoc} */
    public function getAuthKey()
    {
        return null;
    }

    /** {@inheritDoc} */
    public function validateAuthKey($authKey)
    {
        return false;
    }

    /**
     * Validates password.
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model.
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
