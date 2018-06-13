<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$step2 = isset($_GET['step2']) ? $_GET['step2'] : 0;

$page_title = ($step2 == 1) ? 'Create' : 'Update';
$this->title = $page_title . ' Application: ' . $model->application_id;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->application_id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="applications-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?=
    $this->render('_form_step2', [
        'model' => $model,
        'step2' => $step2,
        'institutes' => $institutes,
        'loantypes' => $loantypes,
        'pincode_master' => $pincode_master,
        'itrTable' => $itrTable,
        'nocTable' => $nocTable,
        'kycTable' => $kycTable,
        'resiDocsTable' => $resiDocsTable,
        'resiPhotosTable' => $resiPhotosTable,
        'busiDocsTable' => $busiDocsTable,
        'busiPhotosTable' => $busiPhotosTable,
        'officePhotosTable' => $officePhotosTable,
        'nocPhotosTable' => $nocPhotosTable,
        'resiOfficePhotosTable' => $resiOfficePhotosTable,
        'builderProfilePhotosTable' => $builderProfilePhotosTable,
        'propertyApfPhotosTable' => $propertyApfPhotosTable,
        'indivPropertyPhotosTable' => $indivPropertyPhotosTable,
        'nocSocPhotosTable' => $nocSocPhotosTable,
        'applicationResi' => $applicationResi,
        'applicationBusi' => $applicationBusi,
    ])
    ?>

</div>
