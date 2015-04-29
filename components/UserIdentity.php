<?php

namespace app\components;

use yii\web\IdentityInterface;
use app\models\User;
use yii\base\NotSupportedException;

/**
 * Class UserIdentity
 *
 * @package app\components
 */
class UserIdentity extends User implements IdentityInterface
{
    /**
     * @param int|string $id
     *
     * @return IdentityInterface|static
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @param string      $sToken
     * @param string|null $sType
     *
     * @return void|IdentityInterface
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($sToken, $sType = null)
    {
        throw new NotSupportedException('<strong>findIdentityByAccessToken</strong> is not implemented.');
    }

    /**
     * @return int|mixed|string
     */
    public function getID()
    {
        return $this->getPrimaryKey();
    }

    /**
     * This model extends User. $this->authKey is saved in db on registration.
     * The main use is to authenticate the user by cookie. When you choose to be remembered at Login,
     * this is how you are remembered. The system has to identify and login you somehow. It can either
     * save your username and password in a cookie (that would be unsafe) or it can remember you by
     * other means. This is one of the means.
     *
     * @return string
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $sAuthKey
     *
     * @return bool
     */
    public function validateAuthKey($sAuthKey)
    {
        return $this->getAuthKey() === $sAuthKey;
    }
}