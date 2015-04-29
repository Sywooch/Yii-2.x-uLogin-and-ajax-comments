<?php

namespace app\controllers;

use app\components\UserIdentity;
use app\models\_formLogin;
use app\models\User;
use app\models\UserSocial;
use yii\base\InvalidParamException;
use yii\helpers\Json;
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
        $aReturn = [
            'error' => false
        ];

        if (\Yii::$app->getRequest()->getIsAjax()) {
            try {
                $aData = \Yii::$app->getRequest()->post();
                $mUserSocial = $this->getUserSocial($aData);
                $mUser = $mUserSocial->user;

                if (!$mUser) {
                    $mUser = new User();
                    $mUser->fname = $aData['first_name'];
                    $mUser->sname = $aData['last_name'];

                    if (!$mUser->save()) {
                        throw new InvalidParamException('Cannot save new user model.');
                    }
                }

                \Yii::$app->getUser()->login(UserIdentity::findIdentity($mUser->id), 3600 * 24 * 30);

            } catch (\Exception $oException) {
                $aReturn['error'] = $oException->getMessage();
            }
        }

        return Json::encode($aReturn);
    }

    /**
     * @param array $aData
     *
     * @return UserSocial
     */
    private function getUserSocial($aData)
    {
        $mUserSocial = UserSocial::findOne(['uid' => $aData['uid'], 'network' => $aData['network']]);

        if (!$mUserSocial) {
            $mUserSocial = new UserSocial();
            $mUserSocial->attributes = $aData;

            if (!$mUserSocial->save()) {
                throw new InvalidParamException('Cannot save userSocial model.');
            }
        }

        return $mUserSocial;
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