<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DeviceCredentials */

$this->title = 'Create Device Credentials';
$this->params['breadcrumbs'][] = ['label' => 'Device Credentials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="device-credentials-create">

    <h1 class="hidden"><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'canSetGlobal' => $canSetGlobal
    ])
    ?>

</div>
