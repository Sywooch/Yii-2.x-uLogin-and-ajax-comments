<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/**
 * @var \yii\web\View $this
 * @var string        $content
 */

AppAsset::register($this);
?>

<?php $this->beginPage() ?>

    <!DOCTYPE html>
    <html lang="<?= \Yii::$app->language ?>">
    <head>
        <meta charset="<?= \Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

        <script src="//ulogin.ru/js/ulogin.js"></script>

        <script type="text/javascript">
            function updateNavigation(sNavigation) {
                $('#navigation').replaceWith(sNavigation);
                rebindULogin();
            }

            function rebindULogin() {
                $('[data-action="uLogin"]').each(function () {
                    $(this).removeAttr('data-action');
                    $(this).attr('data-ulogin', 'display=window;fields=first_name,last_name;callback=preview');
                    uLogin.customInit($(this).attr('id'));
                });

                $('[data-action="logout"]').unbind().click(function (oEvent) {
                    oEvent.preventDefault();

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: '/auth/logout',
                        success: function (aData) {
                            updateNavigation(aData.sNavigation);
                        }
                    })
                })
            }

        </script>
    </head>

    <body>

    <?php $this->beginBody() ?>

    <div class="wrap">
        <?= $this->render('_navigation'); ?>

        <div class="container">
            <?= Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : []]) ?>

            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>

    </body>

    </html>

<?php $this->endPage() ?>