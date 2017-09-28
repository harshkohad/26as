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
<div class="user-view">

    <div class="lab-single-header">
        <a href="#" class="lab-back-to" onclick="goBack()">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <span><?= Html::encode($this->title) ?></span>
        <?php
        $currentUserRoutes = array_keys(Helper::getRoutesByUser(Yii::$app->user->id));
        $update = (in_array("/*", $currentUserRoutes) || in_array("/admin/user/index", $currentUserRoutes)) ? ['update', 'id' => $model->id] : ['update'];
        echo Html::a(Html::decode('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'), $update, ['class' => 'lab-edit', 'data' => ['method' => 'post',], 'title' => 'Edit',])
        ?>
        <span class="lab-separator">|</span>
        <?php
        if ($model->status == 0 && Helper::checkRoute($controllerId . 'activate')) {
            echo Html::a(Html::decode('<i class="fa fa-unlock-alt" aria-hidden="true"></i>'), ['activate', 'id' => $model->id], [
                'class' => 'lab-delete',
                'title' => 'Activate',
                'data' => [
                    'confirm' => Yii::t('rbac-admin', 'Are you sure you want to activate this user?'),
                    'method' => 'post',
                ],
            ]);
        }
        ?>
        <span class="lab-separator">|</span>
        <?php
        if ($model->id != Yii::$app->user->id) {
            echo Html::a(Html::decode('<i class="fa fa-trash-o" aria-hidden="true"></i>'), ['delete', 'id' => $model->id], [
                'class' => 'lab-delete',
                'title' => 'Delete',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]);
        }
        ?>
    </div><br>

    <div class="panel panel-default">
        <div class="panel-heading">
            <!--<i class="fa fa-user"></i>-->
            <h3 class="panel-title">My Profile</h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">FIRST NAME</div>
                        <div class="lab-desc"><?= $model->userDetails->first_name ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">MIDDLE NAME</div>
                        <div class="lab-desc"><?= ($model->userDetails->middle_name) ? $model->userDetails->middle_name : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">LAST NAME</div>
                        <div class="lab-desc"><?= $model->userDetails->last_name ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">USERNAME</div>
                        <div class="lab-desc"><?= $model->username ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">EMAIL</div>
                        <div class="lab-desc"><?= $model->email ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">ADDRESS</div>
                        <div class="lab-desc"><?= ($model->userDetails->address) ? $model->userDetails->address : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">CITY</div>
                        <div class="lab-desc"><?= ($model->userDetails->city) ? $model->userDetails->city : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">STATE</div>
                        <div class="lab-desc"><?= ($model->userDetails->state) ? $model->userDetails->state : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">COUNTRY</div>
                        <div class="lab-desc"><?= ($model->userDetails->country) ? $model->userDetails->country : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">PIN CODE</div>
                        <div class="lab-desc"><?= ($model->userDetails->pin) ? $model->userDetails->pin : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">ZIP CODE</div>
                        <div class="lab-desc"><?= ($model->userDetails->zip) ? $model->userDetails->zip : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">PHONE</div>
                        <div class="lab-desc"><?= ($model->userDetails->phone) ? $model->userDetails->phone : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">MOBILE</div>
                        <div class="lab-desc"><?= ($model->userDetails->mobile) ? $model->userDetails->mobile : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">DESIGNATION</div>
                        <div class="lab-desc"><?= ($model->userDetails->designation) ? $model->userDetails->designation : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">LAST LOGIN IP</div>
                        <div class="lab-desc"><?= ($model->userDetails->last_login_ip) ? $model->userDetails->last_login_ip : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">LAST LOGIN TIME</div>
                        <div class="lab-desc"><?= ($model->userDetails->last_login_time) ? $model->userDetails->last_login_time : "&nbsp;" ?></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">CREATED AT</div>
                        <div class="lab-desc"><?= ($model->created_at) ? date("M d, Y", $model->created_at) : "&nbsp;" ?></div>
                    </div> </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">MODIFIED AT</div>
                        <div class="lab-desc"><?= ($model->userDetails->modified_at) ? date("M d, Y", strtotime($model->userDetails->modified_at)) : "&nbsp;" ?></div>
                    </div> </div>
                <div class="col-md-4">
                    <div class="lab-field">
                        <div class="lab-lebel">STATUS</div>
                        <div class="lab-desc"><?= ($model->status == 10) ? "<span style=\"color:GREEN;\">Active</span>" : "<span style=\"color:RED;\">Inactive</span>" ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
