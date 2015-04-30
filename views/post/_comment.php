<?php

use app\models\Comment;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View       $this
 * @var \app\models\Comment $mComment
 */

$oUser = \Yii::$app->getUser();
$mCommentChild = new Comment();

?>

<li class="media" data-comment="<?= $mComment->id; ?>">
    <div class="media-left">
        <a href="#">
            <img class="media-object" src="http://placehold.it/50x50">
        </a>
    </div>

    <div class="media-body">
        <h4 class="media-heading">
            <div class="pull-right">
                <?php if ($mComment->isAuthor($oUser->getID())): ?>
                    <?php $oFormDelete = ActiveForm::begin(['options' => ['data-pjax' => 1]]); ?>
                    <?= Html::hiddenInput('commentID', $mComment->id); ?>
                    <?= Html::submitButton('Delete', ['class' => 'btn btn-xs btn-danger']); ?>
                    <?php ActiveForm::end(); ?>
                <?php endif; ?>

                <?php if (!$oUser->isGuest && $mComment->canComment()) : ?>
                    <a class="btn btn-xs btn-success" onclick="toggleCommentDialog('<?= $mComment->id; ?>');return false;" href="/">Comment</a>
                <?php endif; ?>
            </div>

            <span><?= $mComment->id; ?> <?= $mComment->author->getName(); ?>
                <small class="text-muted"><?= \Yii::$app->getFormatter()->asDatetime($mComment->timeCreate); ?></small></span>
        </h4>

        <p><?= $mComment->content; ?></p>

        <?php $aChildComment = $mComment->getChildComments()->limit(\Yii::$app->params['commentsCount'])->addOrderBy('timeCreate ASC')->all(); ?>

        <?php if ($aChildComment): ?>
            <?= $this->render('_commentList', ['aComment' => $aChildComment]); ?>
        <?php endif; ?>

        <?php if (!$oUser->isGuest && $mComment->canComment()) : ?>
            <div class="hidden" data-id="comment-<?= $mComment->id; ?>">
                <?php $oForm = ActiveForm::begin(['options' => ['data-pjax' => 1]]); ?>

                <?= $oForm->field($mCommentChild, 'content')->textarea(); ?>
                <?= $oForm->field($mCommentChild, 'parentID')->hiddenInput(['value' => $mComment->id])->label(false); ?>

                <?= Html::submitButton('Add', ['class' => 'btn btn-sm btn-primary center-block']); ?>

                <?php ActiveForm::end(); ?>
            </div>
        <?php endif; ?>
    </div>
</li>