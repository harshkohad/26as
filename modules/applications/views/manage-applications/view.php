<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'profile_id',
            'first_name',
            'middle_name',
            'last_name',
            'aadhaar_card_no',
            'pan_card_no',
            'mobile_no',
            'institute_id',
            'loan_type_id',
            'applicant_type',
            'profile_type',
            'area_id',
            'date_of_application',
            'resi_society_name_plate',
            'resi_door_name_plate',
            'resi_tpc_neighbor_1',
            'resi_tpc_neighbor_2',
            'resi_met_person',
            'resi_relation',
            'resi_home_area',
            'resi_owner_ship_status',
            'resi_stay_years',
            'resi_total_family_members',
            'resi_working_members',
            'resi_locality',
            'resi_landmark_1',
            'resi_landmark_2',
            'resi_remarks',
            'busi_tpc_neighbor_1',
            'busi_tpc_neighbor_2',
            'busi_company_name_board',
            'busi_met_person',
            'busi_designation',
            'busi_nature_of_business',
            'busi_staff',
            'busi_years_in_business',
            'busi_type_of_business',
            'busi_ownership_status',
            'busi_area',
            'busi_locality',
            'busi_landmark_1',
            'busi_landmark_2',
            'busi_remarks',
            'office_met_person',
            'office_designation',
            'office_nature_of_company',
            'office_employment_years',
            'office_net_salary_amount',
            'office_tpc_for_applicant',
            'office_tpc_for_company',
            'office_landmark',
            'office_remarks',
            'financial_pan_card_no',
            'financial_name',
            'financial_assessment_year',
            'financial_date_of_filing',
            'financial_sales',
            'financial_share_capital',
            'financial_net_profit',
            'financial_debtors',
            'financial_creditors',
            'financial_total_loans',
            'financial_depriciation',
            'bank_bank_name',
            'bank_account_holder',
            'bank_account_number',
            'bank_dated_transaction',
            'bank_pan_card_no',
            'bank_current_balance',
            'bank_account_opening_date',
            'bank_date_of_birth',
            'bank_address',
            'bank_narration',
            'application_status',
            'mobile_user_id',
            'mobile_user_assigned_date',
            'mobile_user_status',
            'mobile_user_status_updated_on',
            'created_by',
            'created_on',
            'update_by',
            'updated_on',
            'is_deleted',
        ],
    ]) ?>

</div>
