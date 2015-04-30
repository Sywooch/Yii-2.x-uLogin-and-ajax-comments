<?php

use app\models\Comment;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var \yii\web\View       $this
 * @var \app\models\Comment $mComment
 */
?>

<li class="media">
    <div class="media-left">
        <a href="#">
            <img class="media-object" src="http://placehold.it/50x50">
        </a>
    </div>

    <div class="media-body">
        <h4 class="media-heading">
            <div class="pull-right">
                <?php if ($mComment->isAuthor(\Yii::$app->getUser()->getID())): ?>

                    <?php $oFormDelete = ActiveForm::begin(['options' => ['data-pjax' => 1]]); ?>
                    <?= Html::hiddenInput('commentID', $mComment->id); ?>
                    <?= Html::submitButton('Delete', ['class' => 'btn btn-xs btn-danger']); ?>
                    <?php ActiveForm::end(); ?>

                <?php endif; ?>

                <?php if (true): ?>
                    <a class="btn btn-xs btn-success " href="/">Comment</a>
                <?php endif; ?>
            </div>

            <span><?= $mComment->id; ?> <?= $mComment->author->getName(); ?></span>
        </h4>
        <p><?= $mComment->content; ?></p>

        <?php if ($mComment->childComments): ?>
            <ul class="media-list" data-type="comment" data-id="123">
                <?php foreach ($mComment->childComments as $mChildComment): ?>
                    <?= $this->render('_comment', ['mComment' => $mChildComment, 'iParentID' => $mComment->id]); ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div>
            <?php $oForm = ActiveForm::begin(['options' => ['data-pjax' => 1]]); ?>
            <?php $mCommentChild = new Comment(); ?>

            <?= $oForm->field($mCommentChild, 'content')->textarea(); ?>
            <?= $oForm->field($mCommentChild, 'parentID')->hiddenInput(['value' => $mComment->id])->label(false); ?>

            <?= Html::submitButton('Add', ['class' => 'btn btn-sm btn-primary center-block']); ?>

            <?php ActiveForm::end(); ?>
        </div>


    </div>
</li>

