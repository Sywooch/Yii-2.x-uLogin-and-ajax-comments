<?php

namespace app\models;

use app\models\_extend\AbstractActiveRecord;

/**
 * Class Comment
 *
 * @package app\models
 *
 * @property int       $id
 * @property int       $postID
 * @property int       $authorID
 * @property string    $content
 * @property int       $timeCreate
 *
 * @property Post      $post
 * @property User      $author
 * @property Comment[] $childComments
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
            ['parentID', 'safe'],
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

    /**
     * @return bool|void
     */
    public function beforeDelete()
    {
        if ($this->childComments) {
            foreach ($this->childComments as $mComment) {
                $mComment->delete();
            }
        }

        return parent::beforeDelete();
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildComments()
    {
        return $this->hasMany(Comment::className(), ['parentID' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParentComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'parentID']);
    }

    ### functions

    public function isAuthor($userID)
    {
        return $this->authorID == $userID;
    }
}