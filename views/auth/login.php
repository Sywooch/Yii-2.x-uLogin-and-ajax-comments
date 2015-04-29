<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
 * @var yii\web\View           $this
 * @var  app\models\_formLogin $fLogin
 */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Login</h1>
            </div>

            <?php $form = ActiveForm::begin(); ?>

            <div class="panel-body">
                <p class="text-muted">Please fill out the following fields to login:</p>

                <?= $form->field($fLogin, 'username'); ?>
                <?= $form->field($fLogin, 'password')->passwordInput(); ?>
                <?= $form->field($fLogin, 'rememberMe')->checkbox(); ?>
            </div>

            <div class="panel-footer text-center">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

        <p class="text-muted">
            You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
            To modify the username/password, please check out the code <code>app\models\User::$users</code>.
        </p>
    </div>
</div>