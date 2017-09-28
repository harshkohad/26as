<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JobMaster;

/**
 * JobMasterSearch represents the model behind the search form about `app\models\JobMaster`.
 */
class JobMasterSearch extends JobMaster {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['_id', 'action', 'data', 'status', 'user_id', 'created_at', 'modified_at'], 'safe'],
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
        $query = JobMaster::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', '_id', $this->_id])
                ->andFilterWhere(['like', 'action', $this->action])
                ->andFilterWhere(['like', 'data', $this->data])
                ->andFilterWhere(['like', 'status', $this->status])
                ->andFilterWhere(['like', 'user_id', $this->user_id])
                ->andFilterWhere(['like', 'created_at', $this->created_at])
                ->andFilterWhere(['like', 'modified_at', $this->modified_at]);

        return $dataProvider;
    }

}
