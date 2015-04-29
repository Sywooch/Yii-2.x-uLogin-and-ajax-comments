<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class User
 *
 * @package app\models
 *
 * @property int          $id
 * @property string       $fname        First name
 * @property string       $sname        Second\Last name
 *
 * @property Comment[]    $comments
 * @property Post[]       $posts
 * @property UserSocial[] $userSocials
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
            [['fname', 'sname'], 'safe']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'fname' => 'First name',
            'sname' => 'Second name'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserSocials()
    {
        return $this->hasMany(UserSocial::className(), ['userID' => 'id']);
    }

    ### functions

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->fname . ' ' . $this->sname;
    }
}