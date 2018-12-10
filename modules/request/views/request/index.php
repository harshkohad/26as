<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\request\models\RequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Request';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <p>
            <?= Html::a('Create Request', ['create'], ['class' => 'btn btn-success']) ?> 
        </p> 
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
                    'assessment_years:ntext',
                    [
                        'attribute' => 'itr_request_status',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getApplicationStatus($model->id, $model->itr_request_status);
                        },
                        'filter' => ['0' => 'New', '1' => 'Inprogress', '2' => 'Completed'],
                    ],
                    [   
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {delete}',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</section>
