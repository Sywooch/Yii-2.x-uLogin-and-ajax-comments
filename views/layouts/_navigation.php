<?php

use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

/**
 * @var \yii\web\View $this
 */
?>

<?php

NavBar::begin([
    'id' => 'navigation',
    'brandLabel' => 'Blog',
    'brandUrl' => \Yii::$app->homeUrl,
    'options' => ['class' => 'navbar-inverse navbar-fixed-top']
]);

echo Nav::widget([
    'options' => [
        'class' => 'navbar-nav navbar-right'
    ],
    'items' => [
        ['label' => 'Posts', 'url' => ['/post']],
        ['label' => 'About', 'url' => ['/about']],
        \Yii::$app->getUser()->getIsGuest() ?
            [
                'options' => ['id' => 'action-auth'],
                'label' => 'Login',
                'linkOptions' => [
                    'data-action' => 'uLogin',
                    'id' => \Yii::$app->getSecurity()->generateRandomString(5)
                ]
            ] :
            [
                'options' => ['id' => 'action-auth'],
                'label' => 'Logout (' . \Yii::$app->getUser()->getIdentity()->getName() . ')',
                'linkOptions' => ['data-action' => 'logout']
            ]
    ]
]);

NavBar::end();

?>

<script type="text/javascript">
    $(document).ready(function () {
        rebindULogin();
    });
</script>