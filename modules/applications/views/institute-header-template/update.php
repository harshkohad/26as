<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InstituteHeaderTemplate */

$this->title = 'Update Institute Header Template: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Institute Header Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="institute-header-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
