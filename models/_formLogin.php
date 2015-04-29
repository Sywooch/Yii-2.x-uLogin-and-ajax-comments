<?php

namespace app\models;

use yii\base\Model;

/**
 * Class _formLogin
 *
 * @package app\models
 */
class _formLogin extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;
    //
    private $_mUser = false;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @param string $sAttribute
     * @param array  $aParam
     */
    public function validatePassword($sAttribute, $aParam)
    {
        if (!$this->hasErrors()) {
            $mUser = $this->getUser();

            if (!$mUser || !$mUser->validatePassword($this->password)) {
                $this->addError($sAttribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return boolean
     */
    public function login()
    {
        if ($this->validate()) {
            return \Yii::$app->getUser()->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }

        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_mUser === false) {
            $this->_mUser = User::findByUsername($this->username);
        }

        return $this->_mUser;
    }
}