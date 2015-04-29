<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class Comment
 *
 * @package app\models
 *
 * @property int    $id
 * @property int    $postID
 * @property int    $authorID
 * @property string $content
 * @property int    $timeCreate
 *
 * @property Post   $post
 * @property User   $author
 *
 */
class Comment extends AbstractActiveRecord
{
    /**
     * @return string
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['postID', 'authorID', 'content', 'timeCreate'], 'required']
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'postID' => 'Post ID',
            'post' => 'Post',
            'authorID' => 'Author ID',
            'author' => 'Author',
            'content' => 'Content',
            'timeCreate' => 'Time create'
        ];
    }

    ### relations

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'postID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'authorID']);
    }

    ### functions
}