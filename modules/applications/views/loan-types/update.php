<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\LoanTypes */

$this->title = 'Update Loan Type: ' . $model->loan_name;
$this->params['breadcrumbs'][] = ['label' => 'Loan Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->loan_name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loan-types-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
