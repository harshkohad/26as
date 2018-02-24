<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="applications-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'application_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'profile_id')->textInput() ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aadhaar_card_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pan_card_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'institute_id')->textInput() ?>

    <?= $form->field($model, 'loan_type_id')->textInput() ?>

    <?= $form->field($model, 'applicant_type')->textInput() ?>

    <?= $form->field($model, 'profile_type')->textInput() ?>

    <?= $form->field($model, 'area_id')->textInput() ?>

    <?= $form->field($model, 'date_of_application')->textInput() ?>

    <?= $form->field($model, 'resi_society_name_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_door_name_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_tpc_neighbor_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_tpc_neighbor_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_relation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_home_area')->textInput() ?>

    <?= $form->field($model, 'resi_ownership_status')->textInput() ?>

    <?= $form->field($model, 'resi_ownership_status_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_stay_years')->textInput() ?>

    <?= $form->field($model, 'resi_total_family_members')->textInput() ?>

    <?= $form->field($model, 'resi_working_members')->textInput() ?>

    <?= $form->field($model, 'resi_locality')->textInput() ?>

    <?= $form->field($model, 'resi_locality_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_landmark_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_landmark_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_structure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_market_feedback')->textInput() ?>

    <?= $form->field($model, 'resi_remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_status')->textInput() ?>

    <?= $form->field($model, 'busi_tpc_neighbor_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_tpc_neighbor_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_company_name_board')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_nature_of_business')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_staff_declared')->textInput() ?>

    <?= $form->field($model, 'busi_staff_seen')->textInput() ?>

    <?= $form->field($model, 'busi_years_in_business')->textInput() ?>

    <?= $form->field($model, 'busi_type_of_business')->textInput() ?>

    <?= $form->field($model, 'busi_ownership_status')->textInput() ?>

    <?= $form->field($model, 'busi_ownership_status_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_area')->textInput() ?>

    <?= $form->field($model, 'busi_locality')->textInput() ?>

    <?= $form->field($model, 'busi_locality_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_landmark_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_landmark_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_structure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_status')->textInput() ?>

    <?= $form->field($model, 'office_company_name_board')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_met_person_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_nature_of_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_employment_years')->textInput() ?>

    <?= $form->field($model, 'office_net_salary_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_tpc_for_applicant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_tpc_for_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_landmark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_structure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_status')->textInput() ?>

    <?= $form->field($model, 'financial_pan_card_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_assessment_year')->textInput() ?>

    <?= $form->field($model, 'financial_date_of_filing')->textInput() ?>

    <?= $form->field($model, 'financial_sales')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_share_capital')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_net_profit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_debtors')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_creditors')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_total_loans')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'financial_depriciation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_bank_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account_holder')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_dated_transaction')->textInput() ?>

    <?= $form->field($model, 'bank_pan_card_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_current_balance')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_account_opening_date')->textInput() ?>

    <?= $form->field($model, 'bank_date_of_birth')->textInput() ?>

    <?= $form->field($model, 'bank_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_narration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_structure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_society_name_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_door_name_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_tpc_neighbor_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_tpc_neighbor_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_relation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_home_area')->textInput() ?>

    <?= $form->field($model, 'resi_office_ownership_status')->textInput() ?>

    <?= $form->field($model, 'resi_office_ownership_status_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_stay_years')->textInput() ?>

    <?= $form->field($model, 'resi_office_total_family_members')->textInput() ?>

    <?= $form->field($model, 'resi_office_working_members')->textInput() ?>

    <?= $form->field($model, 'resi_office_company_name_board')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_nature_of_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_employment_years')->textInput() ?>

    <?= $form->field($model, 'resi_office_net_salary_amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_tpc_for_applicant')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_tpc_for_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_locality')->textInput() ?>

    <?= $form->field($model, 'resi_office_locality_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_landmark_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_landmark_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_structure')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_market_feedback')->textInput() ?>

    <?= $form->field($model, 'resi_office_remarks')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_status')->textInput() ?>

    <?= $form->field($model, 'builder_profile_company_name_board')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_met_person_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_exsistence')->textInput() ?>

    <?= $form->field($model, 'builder_profile_current_projects')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_previous_projects')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_staff')->textInput() ?>

    <?= $form->field($model, 'builder_profile_area')->textInput() ?>

    <?= $form->field($model, 'builder_profile_type_of_office')->textInput() ?>

    <?= $form->field($model, 'builder_profile_tpc_neighbor_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_tpc_neighbor_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_landmark_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_landmark_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_met_person_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_property_status')->textInput() ?>

    <?= $form->field($model, 'property_apf_no_of_workers')->textInput() ?>

    <?= $form->field($model, 'property_apf_mode_of_payment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_construction_stock')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_total_flats')->textInput() ?>

    <?= $form->field($model, 'property_apf_how_many_sold')->textInput() ?>

    <?= $form->field($model, 'property_apf_total_shops')->textInput() ?>

    <?= $form->field($model, 'property_apf_area')->textInput() ?>

    <?= $form->field($model, 'property_apf_work_completed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_possession')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_apf')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_delay_in_work')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_tpc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_landmark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_met_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_met_person_designation')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_property_confirmed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_previous_owner')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_property_type')->textInput() ?>

    <?= $form->field($model, 'indiv_property_area')->textInput() ?>

    <?= $form->field($model, 'indiv_property_approx_market_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_society_name_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_door_name_plate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_tpc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_landmark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'application_status')->textInput() ?>

    <?= $form->field($model, 'resi_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_address_verification')->textInput() ?>

    <?= $form->field($model, 'resi_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_address_verification')->textInput() ?>

    <?= $form->field($model, 'office_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'office_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_address_verification')->textInput() ?>

    <?= $form->field($model, 'busi_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'busi_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_address_verification')->textInput() ?>

    <?= $form->field($model, 'noc_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'noc_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_address_verification')->textInput() ?>

    <?= $form->field($model, 'resi_office_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'resi_office_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_address_verification')->textInput() ?>

    <?= $form->field($model, 'builder_profile_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'builder_profile_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_address_verification')->textInput() ?>

    <?= $form->field($model, 'property_apf_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_apf_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_address_verification')->textInput() ?>

    <?= $form->field($model, 'indiv_property_address_pincode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_address_trigger')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_address_lat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'indiv_property_address_long')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_on')->textInput() ?>

    <?= $form->field($model, 'update_by')->textInput() ?>

    <?= $form->field($model, 'updated_on')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
