<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceCredentials */

$this->title = $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Device Credentials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$arrCustom = [];
if(in_array($model->protocol, array('ssh', 'telnet')) || $model->protocol == 'snmp' && $model->snmp_version == 'v3') {
    array_push($arrCustom, 'username');
    if ($model->protocol == 'snmp' && $model->snmp_version == 'v3') {
        array_push($arrCustom, 'auth_type');
        array_push($arrCustom, 'privacy_type');
    }
}
else if ($model->protocol == 'snmp' && $model->snmp_version != 'v3') {
    array_push($arrCustom, 'snmp_community');
}
?>
<div class="device-credentials-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => array_merge([
//              'id',
                'label',
//              'username',
//              'password',
//              'enable_password',
//              'protocol:html',    // description attribute in HTML
                [                      // the owner name of the model
                    'label' => 'Protocol',
                    'value' => (($model->protocol == "snmp") ? $model->protocol . "(" . $model->snmp_version . ")" : $model->protocol),
                ],
//              'snmp_version',
            ]
            , 
            $arrCustom
            , 
            [
                'include_devices:ntext',
                'exclude_devices:ntext',
                'sort_order',
                'created_at',
                'modified_at',
//                'created_by',
//                'modified_by',
            ]
        ),
    ]) ?>

</div>
