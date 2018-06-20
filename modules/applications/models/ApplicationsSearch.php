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
            [['id', 'profile_id', 'institute_id', 'loan_type_id', 'applicant_type', 'profile_type', 'area_id', 'application_status', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['application_id', 'first_name', 'middle_name', 'last_name', 'aadhaar_card_no', 'pan_card_no', 'mobile_no', 'date_of_application', 'financial_pan_card_no', 'financial_name', 'financial_assessment_year', 'financial_date_of_filing', 'financial_sales', 'financial_share_capital', 'financial_net_profit', 'financial_debtors', 'financial_creditors', 'financial_total_loans', 'financial_depriciation', 'bank_bank_name', 'bank_account_holder', 'bank_account_number', 'bank_dated_transaction', 'bank_pan_card_no', 'bank_current_balance', 'bank_account_opening_date', 'bank_date_of_birth', 'bank_address', 'bank_narration', 'created_on', 'updated_on', 'case_id'], 'safe'],
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
        $where_cond = \app\components\CommonUtility::checkAuditMode();
        
        $query = Applications::find()->where($where_cond)->orderBy([
            'id' => SORT_DESC,
        ]);

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

        $query->andFilterWhere(['like', 'application_id', $this->application_id])
                ->andFilterWhere(['like', 'first_name', $this->first_name])
                ->andFilterWhere(['like', 'middle_name', $this->middle_name])
                ->andFilterWhere(['like', 'last_name', $this->last_name])
                ->andFilterWhere(['like', 'case_id', $this->case_id])
                ->andFilterWhere(['like', 'aadhaar_card_no', $this->aadhaar_card_no])
                ->andFilterWhere(['like', 'pan_card_no', $this->pan_card_no])
                ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
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
