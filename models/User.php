<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class User
 *
 * @package app\models
 *
 * @property int       $id
 * @property string    $username
 * @property string    $password
 * @property string    $email
 *
 * @property Comment[] $comments
 * @property Post[]    $posts
 */
class User extends AbstractActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['password', 'email'], 'required'],
            ['username', 'safe']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Login',
            'email' => 'Email',
            'password' => 'Password'
        ];
    }

    ### relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['authorID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['authorID' => 'id']);
    }

    ### functions
}