<?php

namespace app\modules\manage_mobile_app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\manage_mobile_app\models\TblMobileUsers;

/**
 * TblMobileUsersSearch represents the model behind the search form about `app\modules\manage_mobile_app\models\TblMobileUsers`.
 */
class TblMobileUsersSearch extends TblMobileUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id'], 'integer'],
            [['mobile_unique_code', 'field_agent_name', 'mobile_imei_number'], 'safe'],
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
        $query = TblMobileUsers::find();

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
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'mobile_unique_code', $this->mobile_unique_code])
            ->andFilterWhere(['like', 'field_agent_name', $this->field_agent_name])
            ->andFilterWhere(['like', 'mobile_imei_number', $this->mobile_imei_number]);

        return $dataProvider;
    }
}
