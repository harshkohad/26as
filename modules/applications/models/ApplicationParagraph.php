<?php

namespace app\modules\applications\models;

use yii\data\ActiveDataProvider;
use Yii;

/**
 * This is the model class for table "tbl_application_paragraph".
 *
 * @property integer $id
 * @property string $name
 * @property resource $paragraph
 * @property string $created_at
 */
class ApplicationParagraph extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_application_paragraph';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
//            [['name', 'paragraph', 'created_at'], 'required'],
            [['paragraph'], 'string'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'paragraph' => 'Paragraph',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {

        $query = ApplicationParagraph::find()->orderBy([
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
        $query->andFilterWhere([
            'id' => $this->id,
            'name' => $this->name,
            'paragraph' => $this->paragraph,
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'modified_by' => $this->modified_by,
            'modified_at' => $this->modified_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
                ->andFilterWhere(['like', 'paragraph', $this->paragraph])
                ->andFilterWhere(['like', 'created_at', $this->created_at]);

        return $dataProvider;
    }

}
