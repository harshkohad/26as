<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\grid\GridView; /* Refer http://demos.krajee.com */

/* @var $this yii\web\View */
/* @var $searchModel app\modules\applications\models\ApplicantProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dedupe Check';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box-body">
    <?php $form = ActiveForm::begin(); ?>
    <div class="">        
        <div class="col-sm-12">
            <div class="form-group col-sm-3">
                <label for="inputFirstName">First Name</label>
                <input type="text" class="form-control" id="inputFirstName" name="inputFirstName">
            </div>
            <div class="form-group col-sm-3">
                <label for="inputMiddleName">Middle Name</label>
                <input type="text" class="form-control" id="inputMiddleName" name="inputMiddleName">
            </div>
            <div class="form-group col-sm-3">
                <label for="inputLastName">Last Name</label>
                <input type="text" class="form-control" id="inputLastName" name="inputLastName">
            </div>
            <div class="form-group col-sm-3">
                <label for="inputMobileNumber">Mobile Number</label>
                <input type="text" class="form-control" id="inputMobileNumber" name="inputMobileNumber">
            </div>
        </div>    
        <div class="col-sm-12">
            <div class="form-group col-sm-3">
                <label for="inputPanCard">PAN Card</label>
                <input type="text" class="form-control" id="inputPanCard" name="inputPanCard">
            </div>
            <div class="form-group col-sm-3">
                <label for="inputAadhaarCard">Aadhaar Card</label>
                <input type="text" class="form-control" id="inputAadhaarCard" name="inputAadhaarCard">
            </div>
        </div>    
        <div class="col-sm-12">
            <div class="form-group text-center">
                <button type="submit" id="dedupe_check" class="btn btn-primary">Search</button>
            </div>
        </div>    
    </div>
    <?php ActiveForm::end(); ?>
</div>    
<?php if ($show_results) : ?>
    <?=
    GridView::widget([
    'dataProvider'=> $dataProvider,
    //'filterModel' => $searchModel,
    'columns' => [
        'first_name',
        'middle_name',
        'last_name',
        'pan_card_no',
        'aadhaar_card_no',
        'passport_number',        
    ],
    'responsive'=>true,
    'hover'=>true
]);
    ?>
<?php endif; ?>


