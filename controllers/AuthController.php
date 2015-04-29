<?php

namespace app\controllers;

use app\models\_formLogin;
use yii\web\Controller;

/**
 * Class AuthController
 *
 * @package app\controllers
 */
class AuthController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionLogin()
    {
        if (!\Yii::$app->getUser()->getIsGuest()) {
            return $this->goHome();
        }

        $fLogin = new _formLogin();

        if ($fLogin->load(\Yii::$app->getRequest()->post()) && $fLogin->login()) {
            return $this->goBack();
        }

        return $this->render('login', ['fLogin' => $fLogin]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        \Yii::$app->getUser()->logout();

        return $this->goHome();
    }
}