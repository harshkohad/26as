<?php

use yii\helpers\Url;

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon orange"><i class="fa fa-share-square-o"></i></span>
            <div class="mini-stat-info">
                <span><?= $model->getStatusCount(0)?></span>
                New Request
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon pink"><i class="fa fa-refresh"></i></span>
            <div class="mini-stat-info">
                <span><?= $model->getStatusCount(1)?></span>
                In-Progress Request
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon green"><i class="fa fa-check"></i></span>
            <div class="mini-stat-info">
                <span><?= $model->getStatusCount(2)?></span>
                Completed Request
            </div>
        </div>
    </div>
<!--    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon green"><i class="fa fa-eye"></i></span>
            <div class="mini-stat-info">
                <span>32720</span>
                Unique Visitors
            </div>
        </div>
    </div>-->
</div>
<!--<script type="text/javascript">
    $(function () {
        $('.banner').css({height: $(window).innerHeight() - 50});
        $(window).resize(function () {
            $('.banner').css({height: $(window).innerHeight() - 50});
        });
    });
</script>-->