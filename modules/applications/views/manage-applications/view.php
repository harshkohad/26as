<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$this->title = $model->application_id;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="applications-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

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


    <div class="body-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('first_name') ?></label>
                <div class="readonlydiv"><?= $model->first_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('middle_name') ?></label>
                <div class="readonlydiv"><?= $model->middle_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('last_name') ?></label>
                <div class="readonlydiv"><?= $model->last_name ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('aadhaar_card_no') ?></label>
                <div class="readonlydiv"><?= $model->aadhaar_card_no ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('pan_card_no') ?></label>
                <div class="readonlydiv"><?= $model->pan_card_no ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('mobile_no') ?></label>
                <div class="readonlydiv"><?= $model->mobile_no ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('institute_id') ?></label>
                <div class="readonlydiv"><?= $model->getInstituteNameType($model->institute_id) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('loan_type_id') ?></label>
                <div class="readonlydiv"><?= $model->getLoanType($model->loan_type_id) ?></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('applicant_type') ?></label>
                <div class="readonlydiv"><?= $model->getApplicantType($model->applicant_type) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('profile_type') ?></label>
                <div class="readonlydiv"><?= $model->getProfileType($model->profile_type) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('area_id') ?></label>
                <div class="readonlydiv"><?= $model->getAreaName($model->area_id) ?></div>
            </div>
            <div class="col-lg-3">
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('date_of_application') ?></label>
                <div class="readonlydiv"><?= $model->date_of_application ?></div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Residence Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control" readonly=""><?= $model->resi_address ?></textarea>
                        <div><label>Send for verification: <?= ($model->resi_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Office Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control" readonly=""><?= $model->office_address ?></textarea>
                        <div><label>Send for verification: <?= ($model->office_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Business Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <textarea class="form-control" readonly=""><?= $model->busi_address ?></textarea>
                        <div><label>Send for verification: <?= ($model->busi_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel-group" id="accordion" style="margin-bottom: 5px;">
            <!--Residence Verification-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#resi_verification"><strong>Residence Verification</strong></a>
                    </h4>
                </div>
                <div id="resi_verification" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_society_name_plate') ?></label>
                                <div class="readonlydiv"><?= $model->resi_society_name_plate ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_door_name_plate') ?></label>
                                <div class="readonlydiv"><?= $model->resi_door_name_plate ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_tpc_neighbor_1') ?></label>
                                <div class="readonlydiv"><?= $model->resi_tpc_neighbor_1 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_tpc_neighbor_2') ?></label>
                                <div class="readonlydiv"><?= $model->resi_tpc_neighbor_2 ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->resi_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_relation') ?></label>
                                <div class="readonlydiv"><?= $model->resi_relation ?></div>
                            </div>                                                        
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_ownership_status') ?></label>
                                <div class="readonlydiv"><?= $model->getOwnershipStatus($model->resi_ownership_status) ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_ownership_status_text') ?></label>
                                <div class="readonlydiv"><?= $model->resi_ownership_status_text ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_home_area') ?></label>
                                <div class="readonlydiv"><?= $model->resi_home_area ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_stay_years') ?></label>
                                <div class="readonlydiv"><?= $model->resi_stay_years ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_total_family_members') ?></label>
                                <div class="readonlydiv"><?= $model->resi_total_family_members ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_working_members') ?></label>
                                <div class="readonlydiv"><?= $model->resi_working_members ?></div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_locality') ?></label>
                                <div class="readonlydiv"><?= $model->getResiLocality($model->resi_locality) ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_locality_text') ?></label>
                                <div class="readonlydiv"><?= $model->resi_locality_text ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_landmark_1') ?></label>
                                <div class="readonlydiv"><?= $model->resi_landmark_1 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_landmark_2') ?></label>
                                <div class="readonlydiv"><?= $model->resi_landmark_2 ?></div>
                            </div> 
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->resi_remarks ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--Business Verification-->
            <div class="panel panel-default cust-panel" style="margin-bottom: 5px !important;">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#busi_verification"><strong>Business Verification</strong></a>
                    </h4>
                </div>
                <div id="busi_verification" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_tpc_neighbor_1') ?></label>
                                <div class="readonlydiv"><?= $model->busi_tpc_neighbor_1 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_tpc_neighbor_2') ?></label>
                                <div class="readonlydiv"><?= $model->busi_tpc_neighbor_2 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_company_name_board') ?></label>
                                <div class="readonlydiv"><?= $model->busi_company_name_board ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->busi_met_person ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_designation') ?></label>
                                <div class="readonlydiv"><?= $model->busi_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_nature_of_business') ?></label>
                                <div class="readonlydiv"><?= $model->busi_nature_of_business ?></div>
                            </div>                            
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_years_in_business') ?></label>
                                <div class="readonlydiv"><?= $model->busi_years_in_business ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_type_of_business') ?></label>
                                <div class="readonlydiv"><?= $model->getBusiType($model->busi_type_of_business) ?></div>
                            </div>
                        </div>

                        <div class="row">                            
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_ownership_status') ?></label>
                                <div class="readonlydiv"><?= $model->getOwnershipStatus($model->busi_ownership_status) ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_ownership_status_text') ?></label>
                                <div class="readonlydiv"><?= $model->busi_ownership_status_text ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_locality') ?></label>
                                <div class="readonlydiv"><?= $model->getBusiLocality($model->busi_locality) ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_locality_text') ?></label>
                                <div class="readonlydiv"><?= $model->busi_locality_text ?></div>
                            </div>                            
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_staff_declared') ?></label>
                                <div class="readonlydiv"><?= $model->busi_staff_declared ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_staff_seen') ?></label>
                                <div class="readonlydiv"><?= $model->busi_staff_seen ?></div>
                            </div>                            
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_area') ?></label>
                                <div class="readonlydiv"><?= $model->busi_area ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_landmark_1') ?></label>
                                <div class="readonlydiv"><?= $model->busi_landmark_1 ?></div>
                            </div>                   
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_landmark_2') ?></label>
                                <div class="readonlydiv"><?= $model->busi_landmark_2 ?></div>
                            </div>
                            <div class="col-lg-9">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->busi_remarks ?></div>
                            </div>
                        </div>    
                    </div>
                </div>
            </div> 

            <!--Office Verification-->
            <div class="panel panel-default cust-panel" style="margin-bottom: 5px !important;">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#office_verification"><strong>Office Verification</strong></a>
                    </h4>
                </div>
                <div id="office_verification" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->office_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_designation') ?></label>
                                <div class="readonlydiv"><?= $model->office_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_nature_of_company') ?></label>
                                <div class="readonlydiv"><?= $model->office_nature_of_company ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_employment_years') ?></label>
                                <div class="readonlydiv"><?= $model->office_employment_years ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_net_salary_amount') ?></label>
                                <div class="readonlydiv"><?= $model->office_net_salary_amount ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_tpc_for_applicant') ?></label>
                                <div class="readonlydiv"><?= $model->office_tpc_for_applicant ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_tpc_for_company') ?></label>
                                <div class="readonlydiv"><?= $model->office_tpc_for_company ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_landmark') ?></label>
                                <div class="readonlydiv"><?= $model->office_landmark ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->office_remarks ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--ITR-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#itr"><strong>ITR</strong></a>
                    </h4>
                </div>
                <div id="itr" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $itrTable; ?>
                    </div>
                </div>
            </div>
            <!--Financial-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#financial"><strong>Financial</strong></a>
                    </h4>
                </div>
                <div id="financial" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_pan_card_no') ?></label>
                                <div class="readonlydiv"><?= $model->financial_pan_card_no ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_name') ?></label>
                                <div class="readonlydiv"><?= $model->financial_name ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_assessment_year') ?></label>
                                <div class="readonlydiv"><?= $model->financial_assessment_year ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_date_of_filing') ?></label>
                                <div class="readonlydiv"><?= $model->financial_date_of_filing ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_sales') ?></label>
                                <div class="readonlydiv"><?= $model->financial_sales ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_share_capital') ?></label>
                                <div class="readonlydiv"><?= $model->financial_share_capital ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_net_profit') ?></label>
                                <div class="readonlydiv"><?= $model->financial_net_profit ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_debtors') ?></label>
                                <div class="readonlydiv"><?= $model->financial_debtors ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_creditors') ?></label>
                                <div class="readonlydiv"><?= $model->financial_creditors ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_total_loans') ?></label>
                                <div class="readonlydiv"><?= $model->financial_total_loans ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('financial_depriciation') ?></label>
                                <div class="readonlydiv"><?= $model->financial_depriciation ?></div>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Bank Statement-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#bank_statement"><strong>Bank Statement</strong></a>
                    </h4>
                </div>
                <div id="bank_statement" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_bank_name') ?></label>
                                <div class="readonlydiv"><?= $model->bank_bank_name ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_account_holder') ?></label>
                                <div class="readonlydiv"><?= $model->bank_account_holder ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_account_number') ?></label>
                                <div class="readonlydiv"><?= $model->bank_account_number ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_dated_transaction') ?></label>
                                <div class="readonlydiv"><?= $model->bank_dated_transaction ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_pan_card_no') ?></label>
                                <div class="readonlydiv"><?= $model->bank_pan_card_no ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_current_balance') ?></label>
                                <div class="readonlydiv"><?= $model->bank_current_balance ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_account_opening_date') ?></label>
                                <div class="readonlydiv"><?= $model->bank_account_opening_date ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_date_of_birth') ?></label>
                                <div class="readonlydiv"><?= $model->bank_date_of_birth ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_address') ?></label>
                                <div class="readonlydiv"><?= $model->bank_address ?></div>
                            </div>
                            <div class="col-lg-6">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('bank_narration') ?></label>
                                <div class="readonlydiv"><?= $model->bank_narration ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--NOC-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#noc"><strong>NOC</strong></a>
                    </h4>
                </div>
                <div id="noc" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $nocTable; ?>
                    </div>
                </div>
            </div>

            <!--KYC-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#kyc"><strong>KYC</strong></a>
                    </h4>
                </div>
                <div id="kyc" class="panel-collapse collapse">
                    <div class="panel-body" id="kyc_table">
                        <?php echo $kycTable; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">              
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <img src="" class="imagepreview" style="width: 100%;">
            </div>
        </div>
    </div>
</div> 

<?php
$this->registerJs("
        $(function(){            
            $(document).on('click', '.pop_kyc', function() {
                var path = $(this).find('img').attr('src');
                var new_path = path.replace('/thumbs', '');
                $('.imagepreview').attr('src', new_path);
                $('#imagemodal').modal('show');   
            });
        });    
");
