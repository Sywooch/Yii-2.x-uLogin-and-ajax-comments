<?php

/**
 * @var \yii\web\View         $this
 * @var \app\models\Comment[] $aComment
 */
?>

<?php if ($aComment) : ?>
    <ul class="media-list">
        <?php foreach ($aComment as $mComment) : ?>
            <?= $this->render('_comment', ['mComment' => $mComment]); ?>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>