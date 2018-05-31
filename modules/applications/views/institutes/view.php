<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Institutes */

$this->title = 'View Institute: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Institutes', 'url' => ['index']];
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
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('name') ?></label>
                <div class="readonlydiv"><?= $model->name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="abbreviation" style=" margin-top: 0px;"><?= $model->getAttributeLabel('abbreviation') ?></label>
                <div class="readonlydiv"><?= $model->abbreviation ?></div>
            </div>
        </div>
    </div>
</section>



</div>
