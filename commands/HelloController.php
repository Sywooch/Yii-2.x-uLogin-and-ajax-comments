<?php

namespace app\commands;

use yii\console\Controller;

/**
 * Class TestController
 *
 * @package app\commands
 */
class TestController extends Controller
{
    /**
     * @param string $sMessage
     */
    public function actionIndex($sMessage = 'Test action.')
    {
        echo $sMessage . "\n";
    }
}