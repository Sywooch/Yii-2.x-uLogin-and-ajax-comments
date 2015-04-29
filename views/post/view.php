<?php

/**
 * @var \yii\web\View    $this
 * @var \app\models\Post $mPost
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

                <ul class="media-list" data-type="comment" data-id="123">
                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="http://placehold.it/50x50">
                            </a>
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading">
                                <div class="pull-right">
                                    <a class="btn btn-xs btn-danger" href="/">Delete</a>
                                    <a class="btn btn-xs btn-success " href="/">Comment</a>
                                </div>

                                <span>Media heading</span>
                            </h4>
                            <p>some generated text</p>

                        </div>
                    </li>

                    <li class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="http://placehold.it/50x50">
                            </a>
                        </div>

                        <div class="media-body">
                            <h4 class="media-heading">
                                <div class="pull-right">
                                    <a class="btn btn-xs btn-danger" href="/">Delete</a>
                                    <a class="btn btn-xs btn-success " href="/">Comment</a>
                                </div>

                                <span>Media heading</span>
                            </h4>
                            <p>some generated text</p>
                        </div>
                    </li>
                </ul>

                <?php if (\Yii::$app->getUser()->getIsGuest()): ?>
                    <a href="#" id="uLogin" data-ulogin="display=window;fields=first_name,last_name;callback=preview"><img src="https://ulogin.ru/img/button.png" width=187 height=30 alt="МультиВход"/></a>
                <?php else: ?>
                    <p>comment form</p>
                <?php endif; ?>


            </div>
        </div>

    </div>

</div>

<script type="text/javascript">
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
                            }
                        }
                    );
                }
            });
    }
</script>