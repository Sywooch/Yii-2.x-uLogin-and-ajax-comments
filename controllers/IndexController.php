<?php

namespace app\controllers;

use yii\web\Controller;

/**
 * Class IndexController
 *
 * @package app\controllers
 */
class IndexController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
//        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
//        $user = json_decode($s, true);
        //$user['network'] - соц. сеть, через которую авторизовался пользователь
        //$user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
        //$user['first_name'] - имя пользователя
        //$user['last_name'] - фамилия пользователя

        return $this->render('index');
    }
}