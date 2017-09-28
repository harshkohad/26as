<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Device Credentials';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-credentials-index">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a('Create Device Credentials', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
            </p>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'label',
                    'username',
//            'password',
//            'enable_password',
//             'protocol',
                    [
                        'attribute' => 'protocol',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return (($model->protocol == "snmp") ? $model->protocol . "(" . $model->snmp_version . ")" : $model->protocol);
                        },
                    ],
//             'snmp_version',
//             'snmp_community',
//             'auth_type',
//             'privacy_type',
//             'include_devices:ntext',
//             'exclude_devices:ntext',
                    'sort_order',
                    'created_at',
                    'modified_at',
//             'created_by',
//             'modified_by',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>