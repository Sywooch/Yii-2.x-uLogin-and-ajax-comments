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

$oUser = \Yii::$app->getUser();

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
                <?php Pjax::begin(['id' => 'comments']); ?>
                <?= $this->render('_commentList', ['aComment' => $aComment]); ?>

                <?php if ($oUser->isGuest): ?>
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

    function toggleCommentDialog(iCommentID) {
        $('[data-id="comment-' + iCommentID + '"]').toggleClass('hidden');
    }

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
                                $.pjax.reload({container: "#comments"});

                                if (aData.isAuth == 1) {
                                    updateNavigation(aData.sNavigation);
                                }
                            }
                        }
                    );
                }
            });
    }

    function showMore(iCommentID) {
        var oLi = $('[data-comment="' + iCommentID + '"]');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {
                sAction: 'showMore',
                iLastCommentID: iCommentID
            },
            success: function (aData) {
                oLi.closest('ul.media-list').find('[data-action="show-more"]').remove();
                oLi.append(aData.sHtml);
            }
        });
    }
</script>