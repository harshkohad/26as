<?php

namespace app\modules\applications\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\applications\models\ApplicationsUploads;

/**
 * ApplicationsUploadsSearch represents the model behind the search form about `app\modules\applications\models\ApplicationsUploads`.
 */
class ApplicationsUploadsSearch extends ApplicationsUploads
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'institute_id', 'loan_type_id', 'status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['file_name', 'created_on', 'updated_on'], 'safe'],
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
        $query = ApplicationsUploads::find();

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
            'institute_id' => $this->institute_id,
            'loan_type_id' => $this->loan_type_id,
            'status' => $this->status,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
