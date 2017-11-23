<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$step2 = isset($_GET['step2']) ? $_GET['step2'] : 0;

$page_title = ($step2 == 1) ? 'Create' : 'Update';
$this->title = $page_title.' Application';
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="applications-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_step2', [
        'model' => $model,
        'step2' => $step2,
        'institutes' => $institutes,
        'loantypes' => $loantypes,
        'area_model' => $area_model,
        'itrTable' => $itrTable,
        'nocTable' => $nocTable,
        'kycTable' => $kycTable,
    ]) ?>

</div>
