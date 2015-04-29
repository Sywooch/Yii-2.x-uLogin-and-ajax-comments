<?php

namespace app\commands;

use app\models\Post;
use app\models\User;
use yii\base\InvalidParamException;
use yii\console\Controller;
use yii\web\NotFoundHttpException;

/**
 * Class GenerateController
 *
 * @package app\commands
 */
class GenerateController extends Controller
{
    /**
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUsers()
    {
        for ($i = 0; $i < 5; $i++) {
            $mUser = new User();
            $mUser->username = 'user' . $i;
            $mUser->password = \Yii::$app->getSecurity()->generatePasswordHash('user1');
            $mUser->email = $mUser->username . '@example.ru';

            if (!$mUser->save()) {
                throw new InvalidParamException('Cannot save new generated user.');
            }
        }

        return true;
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionPosts()
    {
        $aUser = User::find()->all();

        if (!$aUser) {
            throw new NotFoundHttpException('No user presented, cannot create post without user.');
        }

        for ($i = 0; $i < 10; $i++) {
            $mPost = new Post();
            $mPost->authorID = $aUser[mt_rand(0, count($aUser) - 1)]->id;
            $mPost->title = \Yii::$app->getSecurity()->generateRandomString(8);
            $mPost->content = 'Suspendisse viverra magna eu diam efficitur sollicitudin. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum sed lobortis felis. Vestibulum et molestie sapien! Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis metus sem, cursus at gravida et, euismod vitae metus. Sed ullamcorper hendrerit risus, sed ultrices dui. Etiam sed accumsan lorem. Praesent scelerisque hendrerit erat id blandit.';

            if (!$mPost->save()) {
                throw new InvalidParamException('Cannot save new generated post.');
            }
        }

        return true;
    }
}