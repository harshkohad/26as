<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\ApplicantProfile */

$this->title = 'Add Applicant Profile';
$this->params['breadcrumbs'][] = ['label' => 'Applicant Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-applicant-profile-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
