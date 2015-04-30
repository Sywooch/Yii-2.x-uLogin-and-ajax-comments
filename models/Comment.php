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
 * @property int       $parentID
 * @property int       $level
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
            [['postID', 'authorID', 'content', 'timeCreate'], 'required'],
            ['content', 'string', 'min' => 1, 'max' => 100]
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

    /**
     * @return bool
     */
    public function beforeValidate()
    {
        if ($this->level === null) {
            $this->level = $this->countLevel($this);
        }

        return parent::beforeValidate();
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

    /**
     * @param Comment $mComment
     *
     * @return int
     */
    private function countLevel(Comment $mComment)
    {
        $iLevel = 1;

        if ($mComment->parentID) {
            $iLevel += $this->countLevel($mComment->parentComment);
        }

        return $iLevel;
    }

    /**
     * @return bool
     */
    public function canComment()
    {
        return ($this->level < 3);
    }

    /**
     * @return int|string
     */
    public function hasNext()
    {
        return $this->nextCommentsQuery()->count();
    }

    /**
     * @return null|Comment[]
     */
    public function getNextComments()
    {
        return $this->nextCommentsQuery()->limit(\Yii::$app->params['commentsCount'])->all();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function nextCommentsQuery()
    {

        return Comment::find()
            ->where('timeCreate > :timeCreate AND parentID = :parentID', ['timeCreate' => $this->timeCreate, 'parentID' => $this->parentID])
            ->orderBy('timeCreate ASC');
    }
}