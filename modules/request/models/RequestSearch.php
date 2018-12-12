<?php

namespace app\modules\request\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\request\models\Request;

/**
 * RequestSearch represents the model behind the search form of `app\modules\request\models\Request`.
 */
class RequestSearch extends Request
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'itr_request_status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['pan_card_number', 'assessment_years', 'unique_id', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Request::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>['id'=> SORT_DESC],
            ],
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
            'itr_request_status' => $this->itr_request_status,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'pan_card_number', $this->pan_card_number])
            ->andFilterWhere(['like', 'assessment_years', $this->assessment_years])
            ->andFilterWhere(['like', 'unique_id', $this->unique_id]);

        return $dataProvider;
    }
}
