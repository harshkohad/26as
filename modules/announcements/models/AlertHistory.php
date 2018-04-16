<?php

//namespace app\models;

namespace app\modules\announcements\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tbl_alert_history".
 *
 * @property integer $id
 * @property string $message
 * @property string $user_ids
 * @property string $created_at
 * @property integer $created_by
 * @property integer $is_deleted
 */
class AlertHistory extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_alert_history';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['created_at', 'created_by'], 'required'],
            [['created_at'], 'safe'],
            [['created_by', 'is_deleted'], 'integer'],
            [['message', 'user_ids'], 'string', 'max' => 1000],
            [['is_all'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'message' => 'Message',
            'user_ids' => 'User Ids',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function getEmployeeId($ids) {
        $sql = "SELECT concat(first_name,'', last_name) as first_name FROM `tbl_user_details` WHERE user_id IN($ids)";
        $results = Yii::$app->db->createCommand($sql)->queryAll();
        $name = "";
        if (!empty($results)) {
            foreach ($results as $result) {
                $name .= " " . $result['first_name'];
            }
        }
        return $name;
    }

    public function getEmployeeList() {
        $sql = "SELECT concat(first_name,'', last_name) as first_name,user_id from tbl_user_details";
        $results = Yii::$app->db->createCommand($sql)->queryAll();
        $data = array();
        foreach ($results as $key => $value) {
            $data[] = array('id' => $value['user_id'], 'name' => $value['first_name']);
        }
        return json_encode($data);
    }

}
