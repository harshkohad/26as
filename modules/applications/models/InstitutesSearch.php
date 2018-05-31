<?php

namespace app\modules\applications\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\applications\models\Institutes;

/**
 * InstitutesSearch represents the model behind the search form about `app\modules\applications\models\Institutes`.
 */
class InstitutesSearch extends Institutes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'download_pdf', 'download_excel', 'char_count', 'is_alphanumeric', 'is_active', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['name', 'abbreviation', 'file_name', 'created_on', 'updated_on'], 'safe'],
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
        $query = Institutes::find();

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
            'download_pdf' => $this->download_pdf,
            'download_excel' => $this->download_excel,
            'char_count' => $this->char_count,
            'is_alphanumeric' => $this->is_alphanumeric,
            'is_active' => $this->is_active,
            'created_by' => $this->created_by,
            'created_on' => $this->created_on,
            'updated_by' => $this->updated_by,
            'updated_on' => $this->updated_on,
            'is_deleted' => $this->is_deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'abbreviation', $this->abbreviation])
            ->andFilterWhere(['like', 'file_name', $this->file_name]);

        return $dataProvider;
    }
}
