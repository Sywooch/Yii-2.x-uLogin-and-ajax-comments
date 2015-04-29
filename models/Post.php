<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class Post
 *
 * @package app\models
 * @property int       $id
 * @property string    $title
 * @property string    $content
 * @property int       $authorID
 *
 * @property User      $author
 * @property Comment[] $comments
 */
class Post extends AbstractActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['title', 'content', 'authorID'], 'required']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Title',
            'content' => 'Content',
            'authorID' => 'Author ID',
            'author' => 'Author',
        ];
    }

    ### relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'authorID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['postID' => 'id']);
    }

    ### functions
}