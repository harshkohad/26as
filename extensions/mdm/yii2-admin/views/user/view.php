<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
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
            <?php
            if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
                echo Html::a('Activate', ['activate', 'id' => $model->id], [
                    'class' => 'btn btn-success',
                    'data' => [
                        'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                        'method' => 'post',
                    ],
                ]);                
            }
        ?>
        </p>
        <div class="row">
            <div class="col-lg-12">
                <h3>Personal Details</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('first_name') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->first_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('middle_name') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->middle_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('last_name') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->last_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('designation') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->designation ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('mobile') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->mobile ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('phone') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->phone ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('city') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->city ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('state') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->state ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('country') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->country ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('pin') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->pin ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('address') ?></label>
                <textarea class="form-control" readonly=""><?= $model->userDetails->address ?></textarea>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3>Account Details</h3><hr />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('username') ?></label>
                <div class="readonlydiv"><?= $model->username ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('email') ?></label>
                <div class="readonlydiv"><?= $model->email ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('last_login_ip') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->last_login_ip ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('last_login_time') ?></label>
                <div class="readonlydiv"><?= $model->userDetails->last_login_time ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('created_at') ?></label>
                <div class="readonlydiv"><?= date("M d, Y", $model->created_at) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('modified_at') ?></label>
                <div class="readonlydiv"><?= date("M d, Y", strtotime($model->userDetails->modified_at)) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('status') ?></label>
                <div class="readonlydiv"><?= ($model->status == 10) ? "<span style=\"color:GREEN; font-weight: bold;\" >Active</span>" : "<span style=\"color:RED; font-weight: bold;\">Inactive</span>" ?></div>
            </div>
            <div class="col-lg-3">
            </div>
        </div>
    </div>
</section>