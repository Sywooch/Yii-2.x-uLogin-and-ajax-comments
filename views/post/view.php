<?php

use app\models\Comment;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var \yii\web\View         $this
 * @var \app\models\Post      $mPost
 * @var \app\models\Comment[] $aComment
 */

$this->params['breadcrumbs'][] = 'Post';
$this->params['breadcrumbs'][] = 'View';
$this->params['breadcrumbs'][] = $mPost->title;

?>

<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title"><?= $mPost->title; ?></h1>
            </div>

            <div class="panel-body"><?= $mPost->content; ?></div>
        </div>
    </div>

    <div class="col-md-8 col-md-offset-2">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">Comments</h1>
            </div>

            <div class="panel-body">

                <?php Pjax::begin(['id' => 'some123']); ?>

                <ul class="media-list" data-type="comment" data-id="123">
                    <?php foreach ($aComment as $mComment) : ?>
                        <?= $this->render('_comment', ['mComment' => $mComment, 'iParentID' => null]); ?>
                    <?php endforeach; ?>
                </ul>

                <?php if (\Yii::$app->getUser()->getIsGuest()): ?>
                    <a href="#" data-action="uLogin" id="<?= \Yii::$app->getSecurity()->generateRandomString(5); ?>"><img src="https://ulogin.ru/img/button.png" width="187" height="30" alt="МультиВход"/></a>
                <?php else: ?>
                    <?php $oFormComment = ActiveForm::begin(['options' => ['data-pjax' => 1]]); ?>
                    <?php $mComment = new Comment(); ?>

                    <?= $oFormComment->field($mComment, 'content')->textarea(); ?>

                    <?= Html::submitButton('Add', ['class' => 'btn btn-sm btn-primary center-block']); ?>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>

            </div>

            <?php Pjax::end(); ?>

        </div>

    </div>
</div>

<script type="text/javascript">
    //    $(document).on('custom1', function () {
    //        alert('reload');
    //    });
    //    $(document).trigger('custom1');

    function preview(token) {
        $.getJSON("//ulogin.ru/token.php?host=" +
            encodeURIComponent(location.toString()) + "&token=" + token + "&callback=?",
            function (data) {
                data = $.parseJSON(data.toString());

                if (!data.error) {
                    $.ajax({
                            type: 'POST',
                            dataType: 'json',
                            url: '/auth/login',
                            data: data,
                            success: function (aData) {
                                console.log(aData);

                                if (aData.isAuth == 1) {
                                    updateNavigation(aData.sNavigation);
                                }
                            }
                        }
                    );
                }
            });
    }

    $(document).ready(function () {

    });
</script>