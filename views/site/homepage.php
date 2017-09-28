<?php

use yii\helpers\Url;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
$bgimg = Url::to(Yii::$app->view->theme->baseUrl . '/images/homepage-bg.jpg');
$ciscoImg = Url::to(Yii::$app->view->theme->baseUrl . '/images/cisco_logo.png');
?>

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <?= 'Dashboard' ?>
            </div>
        </div>    
    </div>
</div>
<!--<script type="text/javascript">
    $(function () {
        $('.banner').css({height: $(window).innerHeight() - 50});
        $(window).resize(function () {
            $('.banner').css({height: $(window).innerHeight() - 50});
        });
    });
</script>-->