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
 * @property string $pan_card_no
 * @property string $aadhaar_card_no
 * @property string $passport_number
 * @property string $mobile_no
 * @property string $itr_ack_number
 * @property string $bank_account_number
 * @property string $bank_statement_type
 * @property string $company_name
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
            [['first_name', 'middle_name', 'last_name', 'pan_card_no', 'aadhaar_card_no', 'passport_number', 'bank_statement_type'], 'string', 'max' => 255],
            [['mobile_no'], 'string', 'max' => 15],
            [['itr_ack_number'], 'string', 'max' => 45],
            [['bank_account_number'], 'string', 'max' => 20],
            [['company_name'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 1500],
            [['first_name', 'middle_name', 'last_name', 'pan_card_no', 'alternate_contact_no'], 'validateName'],
            [['mobile_no', 'aadhaar_card_no'], 'validateNumber'],
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
            'pan_card_no' => 'Pan Card',
            'aadhaar_card_no' => 'Aadhaar Card',
            'passport_number' => 'Passport Number',
            'mobile_no' => 'Mobile Number',
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
        $where_cond = \app\components\CommonUtility::checkAuditMode();
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
            $query_condition["mobile_no"] = $data['inputMobileNumber'];
        }
        if (!empty($data['inputPanCard'])) {
            $query_condition["pan_card_no"] = $data['inputPanCard'];
        }
        if (!empty($data['inputAadhaarCard'])) {
            $query_condition["aadhaar_card_no"] = $data['inputAadhaarCard'];
        }
        if (!empty($query_condition) OR ! empty($data['inputCompanyName'])) {            
            $query = ApplicantProfile::find()->andwhere($where_cond)->andwhere($query_condition);
            if (!empty($data['inputCompanyName'])) {
                $query->andFilterWhere(['LIKE', 'company_name', $data['inputCompanyName']]);
            }
        } else {
            $query = ApplicantProfile::find()->where($where_cond);
//            /$query->andWhere('0=1');
        }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
    }

}
