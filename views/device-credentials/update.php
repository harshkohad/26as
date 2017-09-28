<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceCredentials */

$this->title = 'Update Device Credentials: ' . ' ' . $model->label;
$this->params['breadcrumbs'][] = ['label' => 'Device Credentials', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="device-credentials-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'canSetGlobal' => $canSetGlobal
    ])
    ?>

</div>
