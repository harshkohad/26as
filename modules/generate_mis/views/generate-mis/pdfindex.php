<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Download PDF';
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
                    'application_id',
                    'first_name',
                    'middle_name',
                    'last_name',
                    'case_id',
                    [
                        'attribute' => 'institute_id',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getInstituteNameType($model->institute_id);
                        }
                    ],
                    [
                        'attribute' => 'loan_type_id',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getLoanType($model->loan_type_id);
                        }
                    ],
                    [
                        'attribute' => 'applicant_type',
                        'label' => 'Applicant Type',
                        'format' => 'raw',
                        'value' => function ($model) {
                            return $model->getApplicantType($model->applicant_type);
                        },
                        'filter' => ['1' => 'Salaried', '0' => 'Self-employed'],
                    ],
                    'date_of_application',
                    [
                        'attribute' => 'created_by',
                        'label' => 'Created By',
                        'value' => function ($data) {
                            if ($data->created_by == NULL) {
                                return "Not Generated";
                            } else {
                                $user_details = User::findIdentity($data->created_by);

                                if (!empty($user_details->username))
                                    return $user_details->username;
                                else
                                    return 'Not Found';
                            }
                        },
                    ],
                    'created_on',
                    [
                        'label' => 'Download PDF',
                        'format' => 'raw',
                        'value' => function ($model) {
                            //return $model->getPdfDownloadButton($model->id);
                            echo $model->id;
                        },
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</section>