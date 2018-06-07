<?php

use yii\helpers\Html;
use yii\grid\GridView;

//use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Paragraphs';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="panel">
    <div class="panel-body">
        <p>
            <?= Html::a('Create Paragraph', ['create-paragraph'], ['class' => 'btn btn-success']) ?> 

        </p> 
        <div>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'filter' => false
                    ],
                    [
                        'attribute' => 'paragraph_type',
                        'value' => [$searchModel, "getParagraphType"],
                        'filter' => false
                    ],
                    [
                        'attribute' => 'type_of_verification',
                        'value' => [$searchModel, "getTypeOfVerificationStatus"],
                        'filter' => false
                    ],
                    [
                        'attribute' => 'door_status',
                        'value' => [$searchModel, "getDoorStatus"],
                        'filter' => false
                    ],
                    [
                        'attribute' => 'paragraph',
                        'filter' => false
                    ],
                    'created_at',
                    'created_by',
//                    'modified_at',
//                    'modified_by',
                    ['class' => 'yii\grid\ActionColumn',
                        'template' => '{update}{delete}',
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update-paragraph', 'id' => $model->id], ['title' => 'Update']);
                            },
                                    'delete' => function ($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete-paragraph', 'id' => $model->id], ['title' => 'Delete', 'data' => [
                                                'confirm' => 'Are you sure you want to delete this paragraph?',
                                                'method' => 'post',
                                            ],]);
                            },
                                ],
                            ],
                        ],
                    ]);
                    ?>
        </div>
    </div>
</section>
