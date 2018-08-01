<?php

namespace mdm\admin\models;

use Yii;

/**
 * This is the model class for table "tbl_user_details".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property string $address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $pin
 * @property string $zip
 * @property string $phone
 * @property string $mobile
 * @property string $designation
 * @property string $created_at
 * @property string $modified_at
 * @property string $current_login_time
 * @property string $last_login_time
 * @property string $current_login_ip
 * @property string $last_login_ip
 */
class UserDetails extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_user_details';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['user_id', 'first_name', 'last_name', 'last_name', 'created_at', 'role_id', 'institute_id', 'loan_id'], 'required'],
            [['user_id', 'pin'], 'integer'],
            ['pin', 'string', 'min' => 6, 'max' => 6],
            ['acronym', 'string', 'min' => 2, 'max' => 3],
            [['created_at', 'modified_at', 'last_login_time', 'last_login_ip', 'address', 'current_login_time', 'current_login_ip', 'country', 'pin'], 'safe'],
            [['first_name', 'middle_name', 'last_name', 'city', 'state', 'designation'], 'string', 'max' => 256],
            [['zip'], 'string', 'max' => 12],
            [['user_id'], 'unique'],
            [['first_name', 'last_name', 'middle_name', 'city', 'state'], 'match', 'pattern' => '/^[a-zA-Z\s\-]+$/'],
            ['designation', 'match', 'pattern' => '/^[a-zA-Z0-9\.\s]+$/'],
            ['zip', 'match', 'pattern' => '/^[\d]+$/'],
            [['mobile', 'phone'], 'match', 'pattern' => '/^\+{0,1}[0-9]{9,12}$/', 'message' => '{attribute} should be like "+ followed by max 12 digits"'],
            //['address', 'match', 'pattern' => '/^[a-zA-Z\.\-\d\s\,]+$/', 'message' => 'Only [.,-] special char allowed.'],
            [['user_id'], 'required', 'on' => 'changePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'acronym' => 'Acronym',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zip' => 'Zip Code',
            'pin' => 'Pin Code',
            'phone' => 'Phone',
            'mobile' => 'Mobile',
            'designation' => 'Designation',
            'created_at' => 'Created At',
            'modified_at' => 'Modified At',
            'last_login_time' => 'Last Login Time',
            'last_login_ip' => 'Last Login IP',
        ];
    }

    /**
     * Callback
     * 
     * @param type $insert
     * @return type
     */
    public function beforeSave($insert) {
        if ($this->isNewRecord) {
            $this->created_at = date("Y-m-d H:i:s");
        }
        $this->modified_at = date("Y-m-d H:i:s");
        return parent::beforeSave($insert);
    }

    public function verifyPin($attribute) {
        if (!preg_match('/^[0-9]{6}$/', $this->$attribute)) {
            $this->addError($attribute, 'must contain exactly 8 digits.');
        }
    }

    public static function updateUserDetails() {
        $model = new UserDetails();
        $model->user_id = Yii::$app->user->id;
        $model->current_login_time = date("Y-m-d H:i:s");
        $model->last_login_time = date("Y-m-d H:i:s");
        $model->current_login_ip = Yii::$app->request->getUserIP();
        $model->last_login_ip = Yii::$app->request->getUserIP();
        $model->save(FALSE);
        return $model;
    }

    public function getSelectedInstitutes() {
        
    }

}
