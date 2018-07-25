<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Manage Users');
$this->params['breadcrumbs'][] = $this->title;
$controllerId = $this->context->uniqueId . '/';

?>
<div class="user-index">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="panel-body">
            <p>
                <?= Html::a('Create New User', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Manage User Password', ['manage-password'], ['class' => 'btn btn-success']) ?>
            </p>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'username',
                        'format' => 'raw',
                        'value' => function ($data) {
                            return "<a href = '" . Url::toRoute("/admin/user/view?id=" . $data->id) . "'>{$data->username}</a>";
                        },
                    ],
                    'email:email',
                    'created_at:date',
                        [
                        'attribute' => 'status',
                        'value' => function($model) {
                            return $model->status == 0 ? 'Inactive' : 'Active';
                        },
                        'filter' => [
                            0 => 'Inactive',
                            10 => 'Active'
                        ]
                    ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Helper::filterActionColumn(['view', 'update', 'activate', 'delete']),
                'buttons' => [
                    'activate' => function($url, $model) {
                        if ($model->status == 10) {
                            return '';
                        }
                        $options = [
                            'title' => Yii::t('rbac-admin', 'Activate'),
                            'aria-label' => Yii::t('rbac-admin', 'Activate'),
                            'data-confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                            'data-method' => 'post',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, $options);
                    }
                        ]
                    ],
                ],
            ]);
            ?>
        </div>
    </div>


</div>
