<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Json;
use mdm\admin\AnimateAsset;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
            'items' => $model->getItems()
        ]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="panel-body">
        <div class="auth-item-view">
            <div class="lab-single-header">
                <?= Html::a(Html::decode('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'), ['update', 'id' => $model->name], ['class' => 'lab-edit']) ?>
                <span class="lab-separator">|</span>
                <?=
                Html::a(Html::decode('<i class="fa fa-trash-o" aria-hidden="true"></i>'), ['delete', 'id' => $model->name], [
                    'class' => 'lab-delete',
                    'data' => [
                        'confirm' => 'Are you sure to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="lab-field">
                        <div class="lab-lebel">NAME</div>
                        <div class="lab-desc"><?= $model->name ?></div>
                    </div>
                    <div class="lab-field">
                        <div class="lab-lebel">DESCRIPTION</div>
                        <div class="lab-desc"><?= ($model->description) ? $model->description : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="lab-field">
                        <div class="lab-lebel">RULE NAME</div>
                        <div class="lab-desc"><?= ($model->ruleName) ? $model->ruleName : "&nbsp;" ?></div>
                    </div>
                    <div class="lab-field">
                        <div class="lab-lebel">DATA</div>
                        <div class="lab-desc"><?= ($model->data) ? nl2br($model->data) : "&nbsp;" ?></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control search" data-target="avaliable"
                           placeholder="<?= Yii::t('rbac-admin', 'Search for avaliable') ?>">
                    <select multiple size="20" class="form-control list" data-target="avaliable"></select>
                </div>
                <div class="col-sm-1">
                    <br><br>
                    <?=
                    Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => $model->name], [
                        'class' => 'btn btn-success btn-assign',
                        'data-target' => 'avaliable',
                        'title' => Yii::t('rbac-admin', 'Assign')
                    ])
                    ?><br><br>
                    <?=
                    Html::a('&lt;&lt;' . $animateIcon, ['remove', 'id' => $model->name], [
                        'class' => 'btn btn-danger btn-assign',
                        'data-target' => 'assigned',
                        'title' => Yii::t('rbac-admin', 'Remove')
                    ])
                    ?>
                </div>
                <div class="col-sm-5">
                    <input class="form-control search" data-target="assigned"
                           placeholder="<?= Yii::t('rbac-admin', 'Search for assigned') ?>">
                    <select multiple size="20" class="form-control list" data-target="assigned"></select>
                </div>
            </div>
        </div>

    </div>
</div>

