<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">
    <div class="lab-single-header hidden">
        <a href="#" class="lab-back-to" onclick="goBack()">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <span><?= Html::encode($this->title) ?></span>
    </div><br>
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
