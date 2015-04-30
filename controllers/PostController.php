<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use yii\web\Controller;

/**
 * Class PostController
 *
 * @package app\controllers
 */
class PostController extends Controller
{
    public $defaultAction = 'list';

    /**
     * @return string
     */
    public function actionList()
    {
        $aPost = Post::find()->all();

        return $this->render('list', ['aPost' => $aPost]);
    }

    /**
     * @param int $id Post ID
     *
     * @return string
     */
    public function actionView($id)
    {
        $mPost = Post::findOne($id);

        if (\Yii::$app->getRequest()->getIsPost()) {
            $mComment = new Comment();
            $mComment->postID = $id;
            $mComment->authorID = \Yii::$app->getUser()->getID();
            $mComment->timeCreate = time();

            if ($mComment->load(\Yii::$app->getRequest()->post())) {
                $mComment->save();
            }

            $iCommentID = \Yii::$app->getRequest()->post('commentID');

            if ($iCommentID) {
                $mComment = Comment::findOne($iCommentID);
                /** @var Comment $mComment */

                if ($mComment) {
                    $mComment->delete();
                }
            }
        }

        $aComment = Comment::findAll(['postID' => $id, 'parentID' => null]);

        return $this->render('view', ['mPost' => $mPost, 'aComment' => $aComment]);
    }
}