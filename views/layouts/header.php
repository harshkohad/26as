<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="index.html" class="logo">       
        <!--<img src=" <?PHP echo Yii::$app->request->baseUrl;?>/images/logo.png" alt="" height="40" style="margin-left: auto; margin-right: auto;">-->
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="nav notify-row" id="top_menu">
    <!--  notification start -->
    <ul class="nav top-menu">
        <!-- notification dropdown start-->
        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                <i class="fa fa-bell-o"></i>
                <span class="badge bg-warning">1</span>
            </a>
            <ul class="dropdown-menu extended notification">
                <li>
                    <p>Notifications</p>
                </li>
                <li>
                    <div class="alert alert-info clearfix">
                        <span class="alert-icon"><i class="fa fa-bolt"></i></span>
                        <div class="noti-info">
                            <a href="#"> Test</a>
                        </div>
                    </div>
                </li>

            </ul>
        </li>
        <!-- notification dropdown end -->
    </ul>
    <!--  notification end -->
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="dist/img/avatar1_small.jpg">
                <span class="username"><?= Yii::$app->user->identity->userDetails->first_name.' '.Yii::$app->user->identity->userDetails->last_name; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><?= Html::a(
                        '<i class=" fa fa-suitcase"></i>Profile</a>',
                        ['/admin/user/view'],
                        ['data-method' => 'post']
                        ); ?></li>
                <!--<li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>-->
                <li><?= Html::a(
                        '<i class="fa fa-key"></i> Log Out</a>',
                        ['/admin/user/logout'],
                        ['data-method' => 'post']
                        ); ?></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
<!--        <li>
            <div class="toggle-right-box">
                <div class="fa fa-bars"></div>
            </div>
        </li>-->
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
