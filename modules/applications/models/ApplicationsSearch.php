<?php

namespace app\modules\applications\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\applications\models\Applications;

/**
 * ApplicationsSearch represents the model behind the search form about `app\modules\applications\models\Applications`.
 */
class ApplicationsSearch extends Applications
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'resi_home_area', 'resi_stay_years', 'resi_total_family_members', 'resi_working_members', 'busi_staff_declared', 'busi_staff_seen', 'busi_years_in_business', 'busi_type_of_business', 'busi_area', 'office_employment_years', 'application_status', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'aadhaar_card_no', 'pan_card_no', 'mobile_no', 'date_of_application', 'resi_society_name_plate', 'resi_door_name_plate', 'resi_tpc_neighbor_1', 'resi_tpc_neighbor_2', 'resi_met_person', 'resi_relation', 'resi_ownership_status', 'resi_ownership_status_text', 'resi_locality', 'resi_landmark_1', 'resi_landmark_2', 'resi_remarks', 'busi_tpc_neighbor_1', 'busi_tpc_neighbor_2', 'busi_company_name_board', 'busi_met_person', 'busi_designation', 'busi_nature_of_business', 'busi_ownership_status', 'busi_ownership_status_text', 'busi_locality', 'busi_landmark_1', 'busi_landmark_2', 'busi_remarks', 'office_met_person', 'office_designation', 'office_nature_of_company', 'office_net_salary_amount', 'office_tpc_for_applicant', 'office_tpc_for_company', 'office_landmark', 'office_remarks', 'financial_pan_card_no', 'financial_name', 'financial_assessment_year', 'financial_date_of_filing', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name', 'bank_account_holder', 'bank_account_number', 'bank_dated_transaction', 'bank_pan_card_no', 'bank_current_balance', 'bank_account_opening_date', 'bank_date_of_birth', 'bank_address', 'bank_narration', 'created_on', 'updated_on', 'application_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
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
    public function search($params)
    {
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
            'resi_stay_years' => $this->resi_stay_years,
            'resi_total_family_members' => $this->resi_total_family_members,
            'resi_working_members' => $this->resi_working_members,
            'busi_staff_declared' => $this->busi_staff_declared,
            'busi_staff_seen' => $this->busi_staff_seen,
            'busi_years_in_business' => $this->busi_years_in_business,
            'busi_type_of_business' => $this->busi_type_of_business,
            'busi_area' => $this->busi_area,
            'office_employment_years' => $this->office_employment_years,
            'financial_assessment_year' => $this->financial_assessment_year,
            'financial_date_of_filing' => $this->financial_date_of_filing,
            'bank_dated_transaction' => $this->bank_dated_transaction,
            'bank_account_opening_date' => $this->bank_account_opening_date,
            'bank_date_of_birth' => $this->bank_date_of_birth,
            'application_status' => $this->application_status,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'update_by' => $this->update_by,
            'updated_on' => $this->updated_on,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
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
            ->andFilterWhere(['like', 'resi_ownership_status', $this->resi_ownership_status])
            ->andFilterWhere(['like', 'resi_locality', $this->resi_locality])
            ->andFilterWhere(['like', 'resi_landmark_1', $this->resi_landmark_1])
            ->andFilterWhere(['like', 'resi_landmark_2', $this->resi_landmark_2])
            ->andFilterWhere(['like', 'resi_remarks', $this->resi_remarks])
            ->andFilterWhere(['like', 'busi_tpc_neighbor_1', $this->busi_tpc_neighbor_1])
            ->andFilterWhere(['like', 'busi_tpc_neighbor_2', $this->busi_tpc_neighbor_2])
            ->andFilterWhere(['like', 'busi_company_name_board', $this->busi_company_name_board])
            ->andFilterWhere(['like', 'busi_met_person', $this->busi_met_person])
            ->andFilterWhere(['like', 'busi_designation', $this->busi_designation])
            ->andFilterWhere(['like', 'busi_nature_of_business', $this->busi_nature_of_business])
            ->andFilterWhere(['like', 'busi_ownership_status', $this->busi_ownership_status])
            ->andFilterWhere(['like', 'busi_locality', $this->busi_locality])
            ->andFilterWhere(['like', 'busi_landmark_1', $this->busi_landmark_1])
            ->andFilterWhere(['like', 'busi_landmark_2', $this->busi_landmark_2])
            ->andFilterWhere(['like', 'busi_remarks', $this->busi_remarks])
            ->andFilterWhere(['like', 'office_met_person', $this->office_met_person])
            ->andFilterWhere(['like', 'office_designation', $this->office_designation])
            ->andFilterWhere(['like', 'office_nature_of_company', $this->office_nature_of_company])
            ->andFilterWhere(['like', 'office_net_salary_amount', $this->office_net_salary_amount])
            ->andFilterWhere(['like', 'office_tpc_for_applicant', $this->office_tpc_for_applicant])
            ->andFilterWhere(['like', 'office_tpc_for_company', $this->office_tpc_for_company])
            ->andFilterWhere(['like', 'office_landmark', $this->office_landmark])
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
            ->andFilterWhere(['like', 'bank_narration', $this->bank_narration]);

        return $dataProvider;
    }
}
