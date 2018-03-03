<?php

namespace app\modules\applications\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\applications\models\Applications;
use mdm\admin\models\UserDetails;

/**
 * ApplicationsSearch represents the model behind the search form about `app\modules\applications\models\Applications`.
 */
class ApplicationsSearch extends Applications {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'resi_home_area', 'resi_ownership_status', 'resi_stay_years', 'resi_total_family_members', 'resi_working_members', 'resi_locality', 'resi_market_feedback', 'resi_status', 'busi_staff_declared', 'busi_staff_seen', 'busi_years_in_business', 'busi_type_of_business', 'busi_ownership_status', 'busi_area', 'busi_locality', 'busi_status', 'office_employment_years', 'office_status', 'resi_office_home_area', 'resi_office_ownership_status', 'resi_office_stay_years', 'resi_office_total_family_members', 'resi_office_working_members', 'resi_office_employment_years', 'resi_office_locality', 'resi_office_market_feedback', 'resi_office_status', 'builder_profile_exsistence', 'builder_profile_staff', 'builder_profile_area', 'builder_profile_type_of_office', 'property_apf_property_status', 'property_apf_no_of_workers', 'property_apf_total_flats', 'property_apf_how_many_sold', 'property_apf_total_shops', 'property_apf_area', 'indiv_property_property_type', 'indiv_property_area', 'application_status', 'resi_address_verification', 'office_address_verification', 'busi_address_verification', 'noc_address_verification', 'resi_office_address_verification', 'builder_profile_address_verification', 'property_apf_address_verification', 'indiv_property_address_verification', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['application_id', 'first_name', 'middle_name', 'last_name', 'aadhaar_card_no', 'pan_card_no', 'mobile_no', 'date_of_application', 'resi_society_name_plate', 'resi_door_name_plate', 'resi_tpc_neighbor_1', 'resi_tpc_neighbor_2', 'resi_met_person', 'resi_relation', 'resi_ownership_status_text', 'resi_locality_text', 'resi_landmark_1', 'resi_landmark_2', 'resi_structure', 'resi_remarks', 'busi_tpc_neighbor_1', 'busi_tpc_neighbor_2', 'busi_company_name_board', 'busi_met_person', 'busi_designation', 'busi_nature_of_business', 'busi_ownership_status_text', 'busi_locality_text', 'busi_landmark_1', 'busi_landmark_2', 'busi_structure', 'busi_remarks', 'office_company_name_board', 'office_designation', 'office_met_person', 'office_met_person_designation', 'office_department', 'office_nature_of_company', 'office_net_salary_amount', 'office_tpc_for_applicant', 'office_tpc_for_company', 'office_landmark', 'office_structure', 'office_remarks', 'financial_pan_card_no', 'financial_name', 'financial_assessment_year', 'financial_date_of_filing', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name', 'bank_account_holder', 'bank_account_number', 'bank_dated_transaction', 'bank_pan_card_no', 'bank_current_balance', 'bank_account_opening_date', 'bank_date_of_birth', 'bank_address', 'bank_narration', 'noc_structure', 'noc_status', 'resi_office_society_name_plate', 'resi_office_door_name_plate', 'resi_office_tpc_neighbor_1', 'resi_office_tpc_neighbor_2', 'resi_office_met_person', 'resi_office_relation', 'resi_office_ownership_status_text', 'resi_office_company_name_board', 'resi_office_designation', 'resi_office_department', 'resi_office_nature_of_company', 'resi_office_net_salary_amount', 'resi_office_tpc_for_applicant', 'resi_office_tpc_for_company', 'resi_office_locality_text', 'resi_office_landmark_1', 'resi_office_landmark_2', 'resi_office_structure', 'resi_office_remarks', 'builder_profile_company_name_board', 'builder_profile_met_person', 'builder_profile_met_person_designation', 'builder_profile_current_projects', 'builder_profile_previous_projects', 'builder_profile_tpc_neighbor_1', 'builder_profile_tpc_neighbor_2', 'builder_profile_landmark_1', 'builder_profile_landmark_2', 'property_apf_met_person', 'property_apf_met_person_designation', 'property_apf_mode_of_payment', 'property_apf_construction_stock', 'property_apf_work_completed', 'property_apf_possession', 'property_apf_apf', 'property_apf_delay_in_work', 'property_apf_tpc', 'property_apf_landmark', 'indiv_property_met_person', 'indiv_property_met_person_designation', 'indiv_property_property_confirmed', 'indiv_property_previous_owner', 'indiv_property_approx_market_value', 'indiv_property_society_name_plate', 'indiv_property_door_name_plate', 'indiv_property_tpc', 'indiv_property_landmark', 'resi_address', 'resi_address_pincode', 'resi_address_trigger', 'resi_address_lat', 'resi_address_long', 'office_address', 'office_address_pincode', 'office_address_trigger', 'office_address_lat', 'office_address_long', 'busi_address', 'busi_address_pincode', 'busi_address_trigger', 'busi_address_lat', 'busi_address_long', 'noc_address', 'noc_address_pincode', 'noc_address_trigger', 'noc_address_lat', 'noc_address_long', 'resi_office_address', 'resi_office_address_pincode', 'resi_office_address_trigger', 'resi_office_address_lat', 'resi_office_address_long', 'builder_profile_address', 'builder_profile_address_pincode', 'builder_profile_address_trigger', 'builder_profile_address_lat', 'builder_profile_address_long', 'property_apf_address', 'property_apf_address_pincode', 'property_apf_address_trigger', 'property_apf_address_lat', 'property_apf_address_long', 'indiv_property_address', 'indiv_property_address_pincode', 'indiv_property_address_trigger', 'indiv_property_address_lat', 'indiv_property_address_long', 'created_on', 'updated_on'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Applications::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $user_id = Yii::$app->user->id;

        $userData = UserDetails::findOne(['user_id' => $user_id]);

        if (!empty($userData)) {
            if (!empty($userData->institute_id) && $userData->institute_id != 0) {
                $query->andFilterWhere(['institute_id' => $userData->institute_id]);
            }
            if (!empty($userData->loan_id) && $userData->loan_id != 0) {
                $query->andFilterWhere(['loan_type_id' => $userData->loan_id]);
            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'profile_id' => $this->profile_id,
            'institute_id' => $this->institute_id,
            'loan_type_id' => $this->loan_type_id,
            'applicant_type' => $this->applicant_type,
            'profile_type' => $this->profile_type,
            'area_id' => $this->area_id,
            'date_of_application' => $this->date_of_application,
            'resi_home_area' => $this->resi_home_area,
            'resi_ownership_status' => $this->resi_ownership_status,
            'resi_stay_years' => $this->resi_stay_years,
            'resi_total_family_members' => $this->resi_total_family_members,
            'resi_working_members' => $this->resi_working_members,
            'resi_locality' => $this->resi_locality,
            'resi_market_feedback' => $this->resi_market_feedback,
            'resi_status' => $this->resi_status,
            'busi_staff_declared' => $this->busi_staff_declared,
            'busi_staff_seen' => $this->busi_staff_seen,
            'busi_years_in_business' => $this->busi_years_in_business,
            'busi_type_of_business' => $this->busi_type_of_business,
            'busi_ownership_status' => $this->busi_ownership_status,
            'busi_area' => $this->busi_area,
            'busi_locality' => $this->busi_locality,
            'busi_status' => $this->busi_status,
            'office_employment_years' => $this->office_employment_years,
            'office_status' => $this->office_status,
            'financial_assessment_year' => $this->financial_assessment_year,
            'financial_date_of_filing' => $this->financial_date_of_filing,
            'bank_dated_transaction' => $this->bank_dated_transaction,
            'bank_account_opening_date' => $this->bank_account_opening_date,
            'bank_date_of_birth' => $this->bank_date_of_birth,
            'resi_office_home_area' => $this->resi_office_home_area,
            'resi_office_ownership_status' => $this->resi_office_ownership_status,
            'resi_office_stay_years' => $this->resi_office_stay_years,
            'resi_office_total_family_members' => $this->resi_office_total_family_members,
            'resi_office_working_members' => $this->resi_office_working_members,
            'resi_office_employment_years' => $this->resi_office_employment_years,
            'resi_office_locality' => $this->resi_office_locality,
            'resi_office_market_feedback' => $this->resi_office_market_feedback,
            'resi_office_status' => $this->resi_office_status,
            'builder_profile_exsistence' => $this->builder_profile_exsistence,
            'builder_profile_staff' => $this->builder_profile_staff,
            'builder_profile_area' => $this->builder_profile_area,
            'builder_profile_type_of_office' => $this->builder_profile_type_of_office,
            'property_apf_property_status' => $this->property_apf_property_status,
            'property_apf_no_of_workers' => $this->property_apf_no_of_workers,
            'property_apf_total_flats' => $this->property_apf_total_flats,
            'property_apf_how_many_sold' => $this->property_apf_how_many_sold,
            'property_apf_total_shops' => $this->property_apf_total_shops,
            'property_apf_area' => $this->property_apf_area,
            'indiv_property_property_type' => $this->indiv_property_property_type,
            'indiv_property_area' => $this->indiv_property_area,
            'application_status' => $this->application_status,
            'resi_address_verification' => $this->resi_address_verification,
            'office_address_verification' => $this->office_address_verification,
            'busi_address_verification' => $this->busi_address_verification,
            'noc_address_verification' => $this->noc_address_verification,
            'resi_office_address_verification' => $this->resi_office_address_verification,
            'builder_profile_address_verification' => $this->builder_profile_address_verification,
            'property_apf_address_verification' => $this->property_apf_address_verification,
            'indiv_property_address_verification' => $this->indiv_property_address_verification,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'update_by' => $this->update_by,
            'updated_on' => $this->updated_on,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'application_id', $this->application_id])
                ->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'middle_name', $this->middle_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'aadhaar_card_no', $this->aadhaar_card_no])
                ->andFilterWhere(['like', 'pan_card_no', $this->pan_card_no])
                ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
                ->andFilterWhere(['like', 'resi_society_name_plate', $this->resi_society_name_plate])
                ->andFilterWhere(['like', 'resi_door_name_plate', $this->resi_door_name_plate])
                ->andFilterWhere(['like', 'resi_tpc_neighbor_1', $this->resi_tpc_neighbor_1])
                ->andFilterWhere(['like', 'resi_tpc_neighbor_2', $this->resi_tpc_neighbor_2])
                ->andFilterWhere(['like', 'resi_met_person', $this->resi_met_person])
                ->andFilterWhere(['like', 'resi_relation', $this->resi_relation])
                ->andFilterWhere(['like', 'resi_ownership_status_text', $this->resi_ownership_status_text])
                ->andFilterWhere(['like', 'resi_locality_text', $this->resi_locality_text])
                ->andFilterWhere(['like', 'resi_landmark_1', $this->resi_landmark_1])
                ->andFilterWhere(['like', 'resi_landmark_2', $this->resi_landmark_2])
                ->andFilterWhere(['like', 'resi_structure', $this->resi_structure])
                ->andFilterWhere(['like', 'resi_remarks', $this->resi_remarks])
                ->andFilterWhere(['like', 'busi_tpc_neighbor_1', $this->busi_tpc_neighbor_1])
                ->andFilterWhere(['like', 'busi_tpc_neighbor_2', $this->busi_tpc_neighbor_2])
                ->andFilterWhere(['like', 'busi_company_name_board', $this->busi_company_name_board])
                ->andFilterWhere(['like', 'busi_met_person', $this->busi_met_person])
                ->andFilterWhere(['like', 'busi_designation', $this->busi_designation])
                ->andFilterWhere(['like', 'busi_nature_of_business', $this->busi_nature_of_business])
                ->andFilterWhere(['like', 'busi_ownership_status_text', $this->busi_ownership_status_text])
                ->andFilterWhere(['like', 'busi_locality_text', $this->busi_locality_text])
                ->andFilterWhere(['like', 'busi_landmark_1', $this->busi_landmark_1])
                ->andFilterWhere(['like', 'busi_landmark_2', $this->busi_landmark_2])
                ->andFilterWhere(['like', 'busi_structure', $this->busi_structure])
                ->andFilterWhere(['like', 'busi_remarks', $this->busi_remarks])
                ->andFilterWhere(['like', 'office_company_name_board', $this->office_company_name_board])
                ->andFilterWhere(['like', 'office_designation', $this->office_designation])
                ->andFilterWhere(['like', 'office_met_person', $this->office_met_person])
                ->andFilterWhere(['like', 'office_met_person_designation', $this->office_met_person_designation])
                ->andFilterWhere(['like', 'office_department', $this->office_department])
                ->andFilterWhere(['like', 'office_nature_of_company', $this->office_nature_of_company])
                ->andFilterWhere(['like', 'office_net_salary_amount', $this->office_net_salary_amount])
                ->andFilterWhere(['like', 'office_tpc_for_applicant', $this->office_tpc_for_applicant])
                ->andFilterWhere(['like', 'office_tpc_for_company', $this->office_tpc_for_company])
                ->andFilterWhere(['like', 'office_landmark', $this->office_landmark])
                ->andFilterWhere(['like', 'office_structure', $this->office_structure])
                ->andFilterWhere(['like', 'office_remarks', $this->office_remarks])
                ->andFilterWhere(['like', 'financial_pan_card_no', $this->financial_pan_card_no])
                ->andFilterWhere(['like', 'financial_name', $this->financial_name])
                ->andFilterWhere(['like', 'financial_sales', $this->financial_sales])
                ->andFilterWhere(['like', 'financial_share_capital', $this->financial_share_capital])
                ->andFilterWhere(['like', 'financial_net_profit', $this->financial_net_profit])
                ->andFilterWhere(['like', 'financial_debtors', $this->financial_debtors])
                ->andFilterWhere(['like', 'financial_creditors', $this->financial_creditors])
                ->andFilterWhere(['like', 'financial_total_loans', $this->financial_total_loans])
                ->andFilterWhere(['like', 'financial_depriciation', $this->financial_depriciation])
                ->andFilterWhere(['like', 'bank_bank_name', $this->bank_bank_name])
                ->andFilterWhere(['like', 'bank_account_holder', $this->bank_account_holder])
                ->andFilterWhere(['like', 'bank_account_number', $this->bank_account_number])
                ->andFilterWhere(['like', 'bank_pan_card_no', $this->bank_pan_card_no])
                ->andFilterWhere(['like', 'bank_current_balance', $this->bank_current_balance])
                ->andFilterWhere(['like', 'bank_address', $this->bank_address])
                ->andFilterWhere(['like', 'bank_narration', $this->bank_narration])
                ->andFilterWhere(['like', 'noc_structure', $this->noc_structure])
                ->andFilterWhere(['like', 'noc_status', $this->noc_status])
                ->andFilterWhere(['like', 'resi_office_society_name_plate', $this->resi_office_society_name_plate])
                ->andFilterWhere(['like', 'resi_office_door_name_plate', $this->resi_office_door_name_plate])
                ->andFilterWhere(['like', 'resi_office_tpc_neighbor_1', $this->resi_office_tpc_neighbor_1])
                ->andFilterWhere(['like', 'resi_office_tpc_neighbor_2', $this->resi_office_tpc_neighbor_2])
                ->andFilterWhere(['like', 'resi_office_met_person', $this->resi_office_met_person])
                ->andFilterWhere(['like', 'resi_office_relation', $this->resi_office_relation])
                ->andFilterWhere(['like', 'resi_office_ownership_status_text', $this->resi_office_ownership_status_text])
                ->andFilterWhere(['like', 'resi_office_company_name_board', $this->resi_office_company_name_board])
                ->andFilterWhere(['like', 'resi_office_designation', $this->resi_office_designation])
                ->andFilterWhere(['like', 'resi_office_department', $this->resi_office_department])
                ->andFilterWhere(['like', 'resi_office_nature_of_company', $this->resi_office_nature_of_company])
                ->andFilterWhere(['like', 'resi_office_net_salary_amount', $this->resi_office_net_salary_amount])
                ->andFilterWhere(['like', 'resi_office_tpc_for_applicant', $this->resi_office_tpc_for_applicant])
                ->andFilterWhere(['like', 'resi_office_tpc_for_company', $this->resi_office_tpc_for_company])
                ->andFilterWhere(['like', 'resi_office_locality_text', $this->resi_office_locality_text])
                ->andFilterWhere(['like', 'resi_office_landmark_1', $this->resi_office_landmark_1])
                ->andFilterWhere(['like', 'resi_office_landmark_2', $this->resi_office_landmark_2])
                ->andFilterWhere(['like', 'resi_office_structure', $this->resi_office_structure])
                ->andFilterWhere(['like', 'resi_office_remarks', $this->resi_office_remarks])
                ->andFilterWhere(['like', 'builder_profile_company_name_board', $this->builder_profile_company_name_board])
                ->andFilterWhere(['like', 'builder_profile_met_person', $this->builder_profile_met_person])
                ->andFilterWhere(['like', 'builder_profile_met_person_designation', $this->builder_profile_met_person_designation])
                ->andFilterWhere(['like', 'builder_profile_current_projects', $this->builder_profile_current_projects])
                ->andFilterWhere(['like', 'builder_profile_previous_projects', $this->builder_profile_previous_projects])
                ->andFilterWhere(['like', 'builder_profile_tpc_neighbor_1', $this->builder_profile_tpc_neighbor_1])
                ->andFilterWhere(['like', 'builder_profile_tpc_neighbor_2', $this->builder_profile_tpc_neighbor_2])
                ->andFilterWhere(['like', 'builder_profile_landmark_1', $this->builder_profile_landmark_1])
                ->andFilterWhere(['like', 'builder_profile_landmark_2', $this->builder_profile_landmark_2])
                ->andFilterWhere(['like', 'property_apf_met_person', $this->property_apf_met_person])
                ->andFilterWhere(['like', 'property_apf_met_person_designation', $this->property_apf_met_person_designation])
                ->andFilterWhere(['like', 'property_apf_mode_of_payment', $this->property_apf_mode_of_payment])
                ->andFilterWhere(['like', 'property_apf_construction_stock', $this->property_apf_construction_stock])
                ->andFilterWhere(['like', 'property_apf_work_completed', $this->property_apf_work_completed])
                ->andFilterWhere(['like', 'property_apf_possession', $this->property_apf_possession])
                ->andFilterWhere(['like', 'property_apf_apf', $this->property_apf_apf])
                ->andFilterWhere(['like', 'property_apf_delay_in_work', $this->property_apf_delay_in_work])
                ->andFilterWhere(['like', 'property_apf_tpc', $this->property_apf_tpc])
                ->andFilterWhere(['like', 'property_apf_landmark', $this->property_apf_landmark])
                ->andFilterWhere(['like', 'indiv_property_met_person', $this->indiv_property_met_person])
                ->andFilterWhere(['like', 'indiv_property_met_person_designation', $this->indiv_property_met_person_designation])
                ->andFilterWhere(['like', 'indiv_property_property_confirmed', $this->indiv_property_property_confirmed])
                ->andFilterWhere(['like', 'indiv_property_previous_owner', $this->indiv_property_previous_owner])
                ->andFilterWhere(['like', 'indiv_property_approx_market_value', $this->indiv_property_approx_market_value])
                ->andFilterWhere(['like', 'indiv_property_society_name_plate', $this->indiv_property_society_name_plate])
                ->andFilterWhere(['like', 'indiv_property_door_name_plate', $this->indiv_property_door_name_plate])
                ->andFilterWhere(['like', 'indiv_property_tpc', $this->indiv_property_tpc])
                ->andFilterWhere(['like', 'indiv_property_landmark', $this->indiv_property_landmark])
                ->andFilterWhere(['like', 'resi_address', $this->resi_address])
                ->andFilterWhere(['like', 'resi_address_pincode', $this->resi_address_pincode])
                ->andFilterWhere(['like', 'resi_address_trigger', $this->resi_address_trigger])
                ->andFilterWhere(['like', 'resi_address_lat', $this->resi_address_lat])
                ->andFilterWhere(['like', 'resi_address_long', $this->resi_address_long])
                ->andFilterWhere(['like', 'office_address', $this->office_address])
                ->andFilterWhere(['like', 'office_address_pincode', $this->office_address_pincode])
                ->andFilterWhere(['like', 'office_address_trigger', $this->office_address_trigger])
                ->andFilterWhere(['like', 'office_address_lat', $this->office_address_lat])
                ->andFilterWhere(['like', 'office_address_long', $this->office_address_long])
                ->andFilterWhere(['like', 'busi_address', $this->busi_address])
                ->andFilterWhere(['like', 'busi_address_pincode', $this->busi_address_pincode])
                ->andFilterWhere(['like', 'busi_address_trigger', $this->busi_address_trigger])
                ->andFilterWhere(['like', 'busi_address_lat', $this->busi_address_lat])
                ->andFilterWhere(['like', 'busi_address_long', $this->busi_address_long])
                ->andFilterWhere(['like', 'noc_address', $this->noc_address])
                ->andFilterWhere(['like', 'noc_address_pincode', $this->noc_address_pincode])
                ->andFilterWhere(['like', 'noc_address_trigger', $this->noc_address_trigger])
                ->andFilterWhere(['like', 'noc_address_lat', $this->noc_address_lat])
                ->andFilterWhere(['like', 'noc_address_long', $this->noc_address_long])
                ->andFilterWhere(['like', 'resi_office_address', $this->resi_office_address])
                ->andFilterWhere(['like', 'resi_office_address_pincode', $this->resi_office_address_pincode])
                ->andFilterWhere(['like', 'resi_office_address_trigger', $this->resi_office_address_trigger])
                ->andFilterWhere(['like', 'resi_office_address_lat', $this->resi_office_address_lat])
                ->andFilterWhere(['like', 'resi_office_address_long', $this->resi_office_address_long])
                ->andFilterWhere(['like', 'builder_profile_address', $this->builder_profile_address])
                ->andFilterWhere(['like', 'builder_profile_address_pincode', $this->builder_profile_address_pincode])
                ->andFilterWhere(['like', 'builder_profile_address_trigger', $this->builder_profile_address_trigger])
                ->andFilterWhere(['like', 'builder_profile_address_lat', $this->builder_profile_address_lat])
                ->andFilterWhere(['like', 'builder_profile_address_long', $this->builder_profile_address_long])
                ->andFilterWhere(['like', 'property_apf_address', $this->property_apf_address])
                ->andFilterWhere(['like', 'property_apf_address_pincode', $this->property_apf_address_pincode])
                ->andFilterWhere(['like', 'property_apf_address_trigger', $this->property_apf_address_trigger])
                ->andFilterWhere(['like', 'property_apf_address_lat', $this->property_apf_address_lat])
                ->andFilterWhere(['like', 'property_apf_address_long', $this->property_apf_address_long])
                ->andFilterWhere(['like', 'indiv_property_address', $this->indiv_property_address])
                ->andFilterWhere(['like', 'indiv_property_address_pincode', $this->indiv_property_address_pincode])
                ->andFilterWhere(['like', 'indiv_property_address_trigger', $this->indiv_property_address_trigger])
                ->andFilterWhere(['like', 'indiv_property_address_lat', $this->indiv_property_address_lat])
                ->andFilterWhere(['like', 'indiv_property_address_long', $this->indiv_property_address_long]);

        return $dataProvider;
    }

}
