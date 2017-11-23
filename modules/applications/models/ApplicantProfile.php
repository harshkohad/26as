<?php

namespace app\modules\applications\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_applicant_profile".
 *
 * @property string $id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $pan_card
 * @property string $aadhaar_card
 * @property string $passport_number
 * @property string $mobile_number
 * @property string $itr_ack_number
 * @property string $bank_account_number
 * @property string $bank_statement_type
 * @property string $address
 * @property string $created_on
 * @property string $update_on
 * @property integer $is_deleted
 */
class ApplicantProfile extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applicant_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['is_deleted'], 'integer'],
            [['created_on', 'update_on'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'pan_card', 'aadhaar_card', 'passport_number', 'bank_statement_type'], 'string', 'max' => 255],
            [['mobile_number'], 'string', 'max' => 15],
            [['itr_ack_number'], 'string', 'max' => 45],
            [['bank_account_number'], 'string', 'max' => 20],
            [['address'], 'string', 'max' => 1500],
            [['first_name', 'middle_name', 'last_name', 'pan_card'], 'validateName'],
            [['mobile_number', 'aadhaar_card'], 'validateNumber'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'pan_card' => 'Pan Card',
            'aadhaar_card' => 'Aadhaar Card',
            'passport_number' => 'Passport Number',
            'mobile_number' => 'Mobile Number',
            'itr_ack_number' => 'ITR Acknowledgement Number',
            'bank_account_number' => 'Bank Account Number',
            'bank_statement_type' => 'Bank Statement Type',
            'address' => 'Address',
            'created_on' => 'Created On',
            'update_on' => 'Update On',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function validateName($attribute, $params) {
        $regex = "/^[a-z0-9]+$/i";
        if (!preg_match($regex, $this->$attribute)) {
            $this->addError($attribute, 'Invalid data, contains spaces or special characters.');
            return true;
        } else {
            return false;
        }
    }

    public function validateNumber($attribute, $params) {
        $regex = "/^[0-9]+$/";
        if (!preg_match($regex, $this->$attribute)) {
            $this->addError($attribute, 'Invalid data, only numbers are allowed.');
            return true;
        } else {
            return false;
        }
    }

    public function applicationsSearch($data) {
        $query_condition = array();
        $dataProvider = '';
        if (!empty($data['inputFirstName'])) {
            $query_condition["first_name"] = $data['inputFirstName'];
        }
        if (!empty($data['inputMiddleName'])) {
            $query_condition["middle_name"] = $data['inputMiddleName'];
        }
        if (!empty($data['inputLastName'])) {
            $query_condition["last_name"] = $data['inputLastName'];
        }
        if (!empty($data['inputMobileNumber'])) {
            $query_condition["mobile_number"] = $data['inputMobileNumber'];
        }
        if (!empty($data['inputPanCard'])) {
            $query_condition["pan_card"] = $data['inputPanCard'];
        }
        if (!empty($data['inputAadhaarCard'])) {
            $query_condition["aadhaar_card"] = $data['inputAadhaarCard'];
        }
        if (!empty($query_condition)) {
            $query = TblApplicantProfile::find()->where($query_condition);
        } else {
            $query = TblApplicantProfile::find();
            $query->where('0=1');
        }            
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }
}
