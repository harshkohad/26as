<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\LoanTypes */

$this->title = 'Create Loan Type';
$this->params['breadcrumbs'][] = ['label' => 'Loan Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loan-types-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
