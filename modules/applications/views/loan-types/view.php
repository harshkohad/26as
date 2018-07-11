<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\LoanTypes */

$this->title = 'View Loan Type: ' . $model->loan_name;
$this->params['breadcrumbs'][] = ['label' => 'Loan Types', 'url' => ['index']];
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
                <label class="control-label" for="loan_name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('loan_name') ?></label>
                <div class="readonlydiv"><?= $model->loan_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="loan_type" style=" margin-top: 0px;"><?= $model->getAttributeLabel('loan_type') ?></label>
                <div class="readonlydiv"><?= $model->getLoanType($model->loan_type) ?></div>
            </div>
        </div>
    </div>
</section>