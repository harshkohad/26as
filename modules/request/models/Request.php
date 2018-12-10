<?php

namespace app\modules\request\models;

use Yii;

/**
 * This is the model class for table "tbl_itr_request".
 *
 * @property int $id
 * @property string $pan_card_number
 * @property int $itr_request_status 0 - new, 1 - inprogress, 2 = completed
 * @property string $assessment_years
 * @property string $unique_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $is_deleted 0 > active, 1 > deleted
 */
class Request extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_itr_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itr_request_status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['pan_card_number', 'assessment_years'], 'required'],
            [['assessment_years'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['pan_card_number', 'unique_id'], 'string', 'max' => 45],
            ['pan_card_number', 'validatePanCard'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pan_card_number' => 'Pan Card',
            'itr_request_status' => 'Status',
            'assessment_years' => 'Assessment Years',
            'unique_id' => 'Unique ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }
    
    public function validatePanCard($attribute, $params) {
        $pattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        if (!empty($this->pan_card_number)) {
            $result = preg_match($pattern, $this->pan_card_number);
            if ($result) {
                $findme = ucfirst(substr($this->pan_card_number, 3, 1));
                $mystring = 'CPHFATBLJG';
                $pos = strpos($mystring, $findme);
                if ($pos === false) {
                    $this->addError($attribute, 'Invalid Pan Card.');
                    return FALSE;
                }
            } else {
                $this->addError($attribute, 'Invalid Pan Card.');
                return FALSE;
            }
        }
    }
    
    public function getRandomUniqueId($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function getApplicationStatus($id, $itr_request_status) {
        $return = '';
        switch ($itr_request_status) {
            case 0:
                $return = '<span style="color:#3c8dbc;font-weight:bold">New</span>';
                break;
            case 1:
                $return = '<span style="color:#d58512;font-weight:bold">Inprogress</span>';
                break;
            case 2:
                $return = '<span style="color:#00a65a;font-weight:bold">Completed</span>';
                break;
        }
        return $return;
    }
}
