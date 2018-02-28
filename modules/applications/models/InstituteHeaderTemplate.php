<?php

namespace app\modules\applications\models;

use yii\data\ActiveDataProvider;
use Yii;
use yii\bootstrap\Html;
use yii\helpers\Url;

/**
 * This is the model class for table "tbl_institute_header_template".
 *
 * @property integer $id
 * @property string $header
 * @property string $fields
 * @property string $final_fields
 * @property string $created_at
 * @property integer $created_by
 * @property integer $institute_id
 */
class InstituteHeaderTemplate extends \yii\db\ActiveRecord {

    public $name = '';
    public $view = '';
    public $start_date = '';
    public $end_date = '';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_institute_header_template';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['fields', 'final_fields'], 'string'],
            [['created_at'], 'safe'],
            [['institute_id'], 'required'],
            [['created_by', 'institute_id'], 'integer'],
            [['header'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'header' => 'Header',
            'fields' => 'Fields',
            'final_fields' => 'Final Fields',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'institute_id' => 'Institute ID',
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search() {
        $query = InstituteHeaderTemplate::find();

        $query->join('INNER JOIN', 'tbl_institutes', 'tbl_institutes.id=tbl_institute_header_template.institute_id');
        $query->select(['tbl_institutes.name', 'institute_id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'institute_id' => $this->institute_id
        ]);
        return $dataProvider;
    }

    public function getJsonInput() {
        $sql = "show columns from tbl_applications";
        $results = Yii::$app->db->createCommand($sql)->queryAll();
        $data = array();
        $ignoreArray = array('id', 'application_id', 'profile_id', 'created_by', 'created_on', 'updated_by', 'updated_on', 'is_deleted');
        foreach ($results as $key => $value) {
            if (!in_array($value['Field'], $ignoreArray))
                $data[] = array('id' => $value['Field'], 'name' => $value['Field']);
        }
        return json_encode($data);
    }

    public function getViewButton($model) {
        return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', Url::toRoute(['institute-header-template/next-template-form', 'id' => $model->institute_id]), ['data-method' => 'post']);
    }

    public function downloadFile($header, $data) {
        if (!empty($data)) {
            ob_get_clean();
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=applications.csv");
            header("Pragma: no-cache");
            header("Expires: 0");
            $file = fopen('php://output', 'w');
            fputcsv($file, $header);
//fputcsv($file, array(1, 2, 4));
            foreach ($data as $row) {
                fputcsv($file, $row);
            }
            $file = fopen('php://output', 'w');
            exit();
        }
        return false;
    }

}
