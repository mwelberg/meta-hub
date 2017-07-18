<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class BackendUser extends ActiveRecord implements IdentityInterface
{

    public static function tableName()
    {
    	return 'user';
    }

    /**
     * Finds an identity by the given ID
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID
     */
    public static function findIdentity($id)
    {
        return static::findOne(['ID' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //return static::findOne(['access_token' => $token]);
        throw new NotSupportedException();
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
    	return static::findOne(['email' => $email]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->ID;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
