<?php

namespace app\modules\applications\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\applications\models\ApplicantProfile;

/**
 * TblApplicantProfileSearch represents the model behind the search form about `app\modules\applications\models\TblApplicantProfile`.
 */
class ApplicantProfileSearch extends ApplicantProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'is_deleted'], 'integer'],
            [['first_name', 'middle_name', 'last_name', 'pan_card_no', 'aadhaar_card_no', 'passport_number', 'mobile_no', 'itr_ack_number', 'bank_account_number', 'bank_statement_type', 'address', 'created_on', 'update_on'], 'safe'],
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
        $query = ApplicantProfile::find();

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
            'created_on' => $this->created_on,
            'update_on' => $this->update_on,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'middle_name', $this->middle_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'pan_card_no', $this->pan_card_no])
            ->andFilterWhere(['like', 'aadhaar_card_no', $this->aadhaar_card_no])
            ->andFilterWhere(['like', 'passport_number', $this->passport_number])
            ->andFilterWhere(['like', 'mobile_no', $this->mobile_no])
            ->andFilterWhere(['like', 'itr_ack_number', $this->itr_ack_number])
            ->andFilterWhere(['like', 'bank_account_number', $this->bank_account_number])
            ->andFilterWhere(['like', 'bank_statement_type', $this->bank_statement_type])
            ->andFilterWhere(['like', 'address', $this->address]);

        return $dataProvider;
    }
}
