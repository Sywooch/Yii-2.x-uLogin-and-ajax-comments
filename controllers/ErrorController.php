<?php

namespace app\controllers;

use yii\base\Exception;
use yii\base\UserException;
use yii\web\Controller;
use yii\web\HttpException;

/**
 * Class ErrorController
 *
 * @package app\controllers
 */
class ErrorController extends Controller
{
    private $_sDefaultMessage;

    /**
     *
     */
    public function init()
    {
        parent::init();

        $this->_sDefaultMessage = 'An internal server error occurred.';
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        $oException = \Yii::$app->getErrorHandler()->exception;

        if ($oException === null) {
            return '';
        }

        $sMessage = ($oException instanceof UserException) ? $oException->getMessage() : $this->_sDefaultMessage;

        if (\Yii::$app->getRequest()->getIsAjax()) {
            return $sMessage;
        }

        return $this->render('index', ['sMessage' => $sMessage]);
    }
}