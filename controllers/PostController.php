<?php

namespace app\controllers;

use app\models\Comment;
use app\models\Post;
use yii\helpers\Json;
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
        $oUser = \Yii::$app->getUser();

        if (!$oUser->isGuest && \Yii::$app->getRequest()->getIsPost()) {
            $mComment = new Comment();
            $mComment->postID = $id;
            $mComment->authorID = \Yii::$app->getUser()->getID();
            $mComment->timeCreate = time();

            if ($mComment->load(\Yii::$app->getRequest()->post())) {
                $mComment->save();
            }

            $iCommentID = \Yii::$app->getRequest()->post('commentID');

            if ($iCommentID) {
                $mComment = Comment::findOne(['authorID' => $oUser->getID(), 'id' => $iCommentID]);
                /** @var Comment $mComment */

                if ($mComment) {
                    $mComment->delete();
                }
            }

            if (\Yii::$app->getRequest()->post('action') == 'showMore'){
                $this->layout = false;
                $mComment = Comment::findOne([\Yii::$app->getRequest()->post('iLastCommentID')]);
                /** @var Comment $mComment */

                $aComment = $mComment->getNextComments();
                $sHtml = ($mComment) ? $this->render('_commentsAjax', ['aComment' => $aComment]) : '';

                return Json::encode(['sHtml' => $sHtml, 'count' => count($aComment)]);
            }
        }

        $aComment = Comment::find()->where('postID = :postID && parentID IS NULL', ['postID' => $id])
            ->orderBy('timeCreate ASC')->limit(\Yii::$app->params['commentsCount'])->all();

        return $this->render('view', ['mPost' => $mPost, 'aComment' => $aComment]);
    }

    /**
     * @return string
     */
    public function actionGetComments()
    {
        $this->layout = false;
        $mComment = Comment::findOne([\Yii::$app->getRequest()->post('iLastCommentID')]);
        /** @var Comment $mComment */

        $aComment = $mComment->getNextComments();
        $sHtml = ($mComment) ? $this->render('_commentsAjax', ['aComment' => $aComment]) : '';

        return Json::encode(['sHtml' => $sHtml, 'count' => count($aComment)]);
    }
}