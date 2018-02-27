<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\applications\models\Applications */

$this->title = $model->application_id;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
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
                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('date_of_application') ?></label>
                <div class="readonlydiv"><?= $model->date_of_application ?></div>
            </div>
        </div>
    </div>
</section>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Residence Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->resi_address ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->resi_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->resi_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->resi_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
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
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->busi_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->busi_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->busi_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->busi_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
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
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->office_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->office_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->office_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->office_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">        
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Residence/Office Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->resi_office_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->resi_office_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->resi_office_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Builder Profile Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->builder_profile_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->builder_profile_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->builder_profile_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Property(APF) Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->property_apf_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->property_apf_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->property_apf_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
        <div class="row">  
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>Individual Property Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->indiv_property_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->indiv_property_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->indiv_property_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>NOC (Society) Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->noc_soc_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->noc_soc_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->noc_soc_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default cust-panel">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <strong>NOC (Business/Conditional) Address</strong>
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_address') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->noc_address ?></textarea>
                            </div>    
                        </div>  
                        <div class="row">    
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_address_pincode') ?></label>
                                <div class="readonlydiv"><?= $model->noc_address_pincode ?></div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_address_trigger') ?></label>
                                <textarea class="form-control" readonly=""><?= $model->noc_address_trigger ?></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label>Send for verification: <?= ($model->noc_address_verification == 1) ? 'TRUE' : 'FALSE' ?></label>
                            </div>
                        </div>    
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
                            <div class="col-lg-9">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_structure') ?></label>
                                <div class="readonlydiv"><?= $model->resi_structure ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label>Market Feedback</label>
                                <div class="readonlydiv"><?= ($model->resi_market_feedback == 0) ? 'Positive' : 'Negative' ?></div>
                            </div>                           
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Docs</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="resi_docs">
                                            <?php echo $resiDocsTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="resi_photos">
                                            <?php echo $resiPhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->resi_remarks ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label>Status</label>
                                <div class="readonlydiv"><?= ($model->resi_status == 0) ? 'Positive' : (($model->resi_status == 1) ? 'Negative' : 'Credit Refer') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--Business Verification-->
            <div class="panel panel-default cust-panel">
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
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_structure') ?></label>
                                <div class="readonlydiv"><?= $model->busi_structure ?></div>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Docs</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="busi_docs">
                                            <?php echo $busiDocsTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="busi_photos">
                                            <?php echo $busiPhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>                      
                        </div>

                        <div class="row">                            
                            <div class="col-lg-12">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('busi_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->busi_remarks ?></div>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Status</label>
                                <div class="readonlydiv"><?= ($model->busi_status == 0) ? 'Positive' : (($model->busi_status == 1) ? 'Negative' : 'Credit Refer') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

            <!--Office Verification-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#office_verification"><strong>Office Verification</strong></a>
                    </h4>
                </div>
                <div id="office_verification" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_company_name_board') ?></label>
                                <div class="readonlydiv"><?= $model->office_company_name_board ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_designation') ?></label>
                                <div class="readonlydiv"><?= $model->office_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->office_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_met_person_designation') ?></label>
                                <div class="readonlydiv"><?= $model->office_met_person_designation ?></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_department') ?></label>
                                <div class="readonlydiv"><?= $model->office_department ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_nature_of_company') ?></label>
                                <div class="readonlydiv"><?= $model->office_nature_of_company ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_employment_years') ?></label>
                                <div class="readonlydiv"><?= $model->office_employment_years ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_net_salary_amount') ?></label>
                                <div class="readonlydiv"><?= $model->office_net_salary_amount ?></div>
                            </div>
                        </div>
                        <div class="row">
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
                            <div class="col-lg-6">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('office_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->office_remarks ?></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="office_photos">
                                            <?php echo $officePhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3">
                                <label>Status</label>
                                <div class="readonlydiv"><?= ($model->office_status == 0) ? 'Positive' : (($model->office_status == 1) ? 'Negative' : 'Credit Refer') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--Residence/Office Verification-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#resi_office_verification"><strong>Residence/Office Verification</strong></a>
                    </h4>
                </div>
                <div id="resi_office_verification" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_society_name_plate') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_society_name_plate ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_door_name_plate') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_door_name_plate ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_tpc_neighbor_1') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_tpc_neighbor_1 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_tpc_neighbor_2') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_tpc_neighbor_2 ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_relation') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_relation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_ownership_status') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_ownership_status ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_ownership_status_text') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_ownership_status_text ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_home_area') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_home_area ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_stay_years') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_stay_years ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_total_family_members') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_total_family_members ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_working_members') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_working_members ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_company_name_board') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_company_name_board ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_designation') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_met_person_designation') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_met_person_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_department') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_department ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_nature_of_company') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_nature_of_company ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_employment_years') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_employment_years ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_net_salary_amount') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_net_salary_amount ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_tpc_for_applicant') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_tpc_for_applicant ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_tpc_for_company') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_tpc_for_company ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_locality') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_locality ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_locality_text') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_locality_text ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_landmark_1') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_landmark_1 ?></div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_landmark_2') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_landmark_2 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_structure') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_structure ?></div>
                            </div>
                            <div class="col-lg-3"> 
                                <label>Market Feedback</label>
                                <div class="readonlydiv"><?= ($model->resi_office_market_feedback == 0) ? 'Positive' : 'Negative' ?></div>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                        <div class="row">                           
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="office_photos">
<?php echo $resiOfficePhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-9">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('resi_office_remarks') ?></label>
                                <div class="readonlydiv"><?= $model->resi_office_remarks ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label>Status</label>
                                <div class="readonlydiv"><?= ($model->resi_office_status == 0) ? 'Positive' : (($model->resi_office_status == 1) ? 'Negative' : 'Credit Refer') ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Builder Profile-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#builder_profile"><strong>Builder Profile</strong></a>
                    </h4>
                </div>
                <div id="builder_profile" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_company_name_board') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_company_name_board ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_met_person_designation') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_met_person_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_exsistence') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_exsistence ?></div>
                            </div>
                        </div>                    
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_current_projects') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_current_projects ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_previous_projects') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_previous_projects ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_staff') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_staff ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_area') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_area ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_type_of_office') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_type_of_office ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_tpc_neighbor_1') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_tpc_neighbor_1 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_tpc_neighbor_2') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_tpc_neighbor_2 ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_landmark_1') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_landmark_1 ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('builder_profile_landmark_2') ?></label>
                                <div class="readonlydiv"><?= $model->builder_profile_landmark_2 ?></div>
                            </div>
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="office_photos">
    <?php echo $builderProfilePhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Property(APF)-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#property_apf"><strong>Property (APF)</strong></a>
                    </h4>
                </div>
                <div id="property_apf" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_met_person_designation') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_met_person_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_property_status') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_property_status ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_no_of_workers') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_no_of_workers ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_mode_of_payment') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_mode_of_payment ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_construction_stock') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_construction_stock ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_total_flats') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_total_flats ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_how_many_sold') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_how_many_sold ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_total_shops') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_total_shops ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_area') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_area ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_work_completed') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_work_completed ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_possession') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_possession ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_apf') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_apf ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_delay_in_work') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_delay_in_work ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_tpc') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_tpc ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('property_apf_landmark') ?></label>
                                <div class="readonlydiv"><?= $model->property_apf_landmark ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="office_photos">
<?php echo $propertyApfPhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Individual Property-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#individual_property"><strong>Individual Property</strong></a>
                    </h4>
                </div>
                <div id="individual_property" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_met_person_designation') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_met_person_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_property_confirmed') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_property_confirmed ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_previous_owner') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_previous_owner ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_property_type') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_property_type ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_area') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_area ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_approx_market_value') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_approx_market_value ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_society_name_plate') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_society_name_plate ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_door_name_plate') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_door_name_plate ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_tpc') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_tpc ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('indiv_property_landmark') ?></label>
                                <div class="readonlydiv"><?= $model->indiv_property_landmark ?></div>
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="office_photos">
<?php echo $indivPropertyPhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
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
            
            <!--NOC (Society)-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#noc_soc"><strong>NOC (Society)</strong></a>
                    </h4>
                </div>
                <div id="noc_soc" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_met_person') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_met_person ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_met_person_designation') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_met_person_designation ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_signature_done_by') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_signature_done_by ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_bldg_reg_number') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_bldg_reg_number ?></div>
                            </div>
                        </div>                        
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_society_type') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_society_type ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_soc_previous_owner') ?></label>
                                <div class="readonlydiv"><?= $model->noc_soc_previous_owner ?></div>
                            </div>
                            <div class="col-lg-3">
                            </div>
                            <div class="col-lg-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="office_photos">
<?php echo $nocSocPhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--NOC (Business/Conditional)-->
            <div class="panel panel-default cust-panel">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#noc"><strong>NOC (Business/Conditional)</strong></a>
                    </h4>
                </div>
                <div id="noc" class="panel-collapse collapse">
                    <div class="panel-body">
                        <?php echo $nocTable; ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="panel panel-default cust-panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <strong>Photos</strong>
                                        </h4>
                                    </div>
                                    <div class="panel-body" style="height: 200px;overflow-y: auto;">
                                        <div id="noc_photos">
                                            <?php echo $nocPhotosTable; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6"></div>
                        </div>

                        <div class="row">
                            <div class="col-lg-9">
                                <label class="control-label" for="name" style=" margin-top: 0px;"><?= $model->getAttributeLabel('noc_structure') ?></label>
                                <div class="readonlydiv"><?= $model->noc_structure ?></div>
                            </div>
                            <div class="col-lg-3">
                                <label>Status</label>
                                <div class="readonlydiv"><?= ($model->noc_status == 0) ? 'Positive' : (($model->noc_status == 1) ? 'Negative' : 'Credit Refer') ?></div>
                            </div>
                        </div>
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
