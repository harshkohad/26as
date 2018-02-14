<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\manage_mobile_app\models\TblMobileUsers */

$this->title = $model->field_agent_name;
$this->params['breadcrumbs'][] = ['label' => 'Mobile Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <p>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
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
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('field_agent_name') ?></label>
                <div class="readonlydiv"><?= $model->field_agent_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('mobile_unique_code') ?></label>
                <div class="readonlydiv"><?= $model->mobile_unique_code ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('mobile_imei_number') ?></label>
                <div class="readonlydiv"><?= $model->mobile_imei_number ?></div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>
</section>