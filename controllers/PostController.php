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

        return $this->render('view', ['mPost' => $mPost]);
    }
}