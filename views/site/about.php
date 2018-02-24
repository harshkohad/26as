<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$supportEmail = Yii::$app->params['supportEmail'];
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is a proof of concept <b>Enterprise Network Automation Tool </b> developed by <b>Infinity Labs</b>, for suggestions please write to <a href="mailto:<?= $supportEmail ?>"><?= $supportEmail ?></a>
    </p>

</div>
