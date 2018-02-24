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
    <div class="panel-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->name], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </p>

        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('name') ?></label>
                <div class="readonlydiv"><?= $model->name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('description') ?></label>
                <div class="readonlydiv"><?= $model->description ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('ruleName') ?></label>
                <textarea class="form-control" readonly=""><?= $model->ruleName ?></textarea>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('data') ?></label>
                <textarea class="form-control" readonly=""><?= $model->data ?></textarea>
            </div>
        </div>
        <div style="clear:both; height: 30px;"></div>
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

