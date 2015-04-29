<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class UserSocial
 *
 * @package app\models
 *
 * @property int    $id
 * @property int    $userID
 * @property string $first_name
 * @property string $second_name
 * @property string $network
 * @property string $profile
 * @property int    $uid
 * @property string $identity
 * @property string $manual
 * @property int    $verified_email
 * @property string $email
 *
 * @property User   $user
 */
class UserSocial extends AbstractActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'user_social';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['userID', 'first_name', 'last_name', 'network', 'profile', 'uid', 'identity', 'manual', 'verified_email', 'email'], 'safe']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [];
    }

    ### relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userID']);
    }

    ### functions
}