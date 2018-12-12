<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\request\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Process';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <div>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'pan_card_number',
                    [
                        'header' => 'Request Date',
                        'attribute' => 'created_at',
                    ],
                    [
                        'attribute' => 'created_by',
                        'label' => 'Created By',
                        'value' => function ($data) {
                            if ($data->created_by == NULL) {
                                return "Not Generated";
                            } else {
                                $user_details = mdm\admin\models\searchs\User::findIdentity($data->created_by);

                                if (!empty($user_details->emp_name))
                                    return $user_details->emp_name;
                                else
                                    return 'Not Found';
                            }
                        },
                    ],
                    'assessment_years:ntext',
                    [
                        'attribute' => 'itr_request_status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getApplicationStatus($model->id, $model->itr_request_status);
                        },
                        'filter' => ['0' => 'New', '1' => 'Inprogress', '2' => 'Completed'],
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'update' => function ($url, $model) {
                                return ($model->itr_request_status == 0 || $model->itr_request_status == 1) ? Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url) : '';
                            },
                            'view' => function ($url, $model) {
                                return ($model->itr_request_status == 2) ? Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url) : '';
                            },
                            'delete' => function ($url, $model) {
                                return ($model->itr_request_status == 0 || $model->itr_request_status == 1) ? Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], [
                                            'class' => '',
                                            'data' => [
                                                'confirm' => 'Are you absolutely sure ? You will lose all the information about this user with this action.',
                                                'method' => 'post',
                                            ],
                                        ]) : '';
                            },
                        ],
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</section>
