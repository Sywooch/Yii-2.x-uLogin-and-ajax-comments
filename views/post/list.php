<?php

use yii\helpers\Url;

/**
 * @var \yii\web\View      $this
 * @var \app\models\Post[] $aPost
 */

$this->params['breadcrumbs'][] = 'Post';
$this->params['breadcrumbs'][] = 'List';

?>

<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php if ($aPost): ?>

            <?php foreach ($aPost as $mPost): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title"><?= $mPost->title; ?></h1>
                    </div>


                    <div class="panel-body">
                        <?= $mPost->content; ?>
                    </div>

                    <div class="panel-footer text-right">
                        <a href="<?= Url::to(['post/view', 'id' => $mPost->id]); ?>">More...</a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <p class="alert alert-danger text-center">No posts presented.</p>
            <p class="alert text-center">Call in console <code>php yii generate/posts</code>, from root folder.</p>
        <?php endif; ?>
    </div>
</div>