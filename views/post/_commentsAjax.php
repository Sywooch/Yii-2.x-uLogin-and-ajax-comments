<?php
/**
 * @var \yii\web\View         $this
 * @var \app\models\Comment[] $aComment
 */
?>

<?php foreach ($aComment as $mComment): ?>
    <?= $this->render('_comment', ['mComment' => $mComment]); ?>
<?php endforeach; ?>

<?php $mCommentLast = $aComment[count($aComment) - 1]; ?>

<?php if ($mCommentLast->hasNext()) : ?>
    <p class="alert text-center" data-action="show-more">
        <a href="#" class="btn btn-xs btn-default" onclick="showMore('<?= $mCommentLast->id; ?>');return false;">Show more...</a>
    </p>
<?php endif; ?>