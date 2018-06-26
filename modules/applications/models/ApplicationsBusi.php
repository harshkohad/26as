<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_busi".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $busi_tpc_neighbor_1
 * @property string $busi_tpc_neighbor_2
 * @property string $busi_company_name_board
 * @property string $busi_met_person
 * @property string $busi_designation
 * @property string $busi_designation_others
 * @property string $busi_nature_of_business
 * @property integer $busi_staff_declared
 * @property integer $busi_staff_seen
 * @property integer $busi_years_in_business
 * @property integer $busi_type_of_business
 * @property integer $busi_ownership_status
 * @property string $busi_ownership_status_text
 * @property integer $busi_area
 * @property integer $busi_locality
 * @property string $busi_locality_text
 * @property integer $busi_locality_type
 * @property string $busi_landmark_1
 * @property string $busi_landmark_2
 * @property integer $busi_activity_seen
 * @property string $busi_structure
 * @property string $busi_remarks
 * @property integer $busi_status
 * @property integer $busi_is_reachable
 * @property string $busi_not_reachable_remarks
 * @property string $busi_rented_owner_name
 * @property string $busi_rent_amount
 * @property integer $busi_available_status
 * @property integer $busi_shifted_tenure
 * @property string $busi_reason_for_closed
 * @property string $busi_address
 * @property integer $busi_address_verification
 * @property string $busi_address_pincode
 * @property string $busi_address_trigger
 * @property string $busi_address_lat
 * @property string $busi_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsBusi extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_busi';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id'], 'required'],
            [['application_id', 'busi_staff_declared', 'busi_staff_seen', 'busi_years_in_business', 'busi_type_of_business', 'busi_ownership_status', 'busi_area', 'busi_locality', 'busi_locality_type', 'busi_activity_seen', 'busi_status', 'busi_available_status', 'busi_shifted_tenure', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on', 'busi_address_pincode', 'busi_address_lat', 'busi_address_long', 'busi_is_reachable'], 'safe'],
            [['busi_not_reachable_remarks'], 'string'],
            [['busi_tpc_neighbor_1', 'busi_tpc_neighbor_2', 'busi_company_name_board', 'busi_met_person', 'busi_designation', 'busi_nature_of_business', 'busi_ownership_status_text', 'busi_locality_text', 'busi_landmark_1', 'busi_landmark_2'], 'string', 'max' => 150],
            [['busi_designation_others', 'busi_rented_owner_name', 'busi_reason_for_closed'], 'string', 'max' => 100],
            [['busi_structure', 'busi_remarks', 'busi_address', 'busi_address_trigger'], 'string', 'max' => 1000],
            [['busi_rent_amount'], 'string', 'max' => 500],
//            [['busi_address_pincode'], 'string', 'max' => 10],
            //[['busi_address_lat', 'busi_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'busi_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'busi_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'busi_company_name_board' => 'Company Name Board',
            'busi_met_person' => 'Met Person',
            'busi_designation' => 'Designation',
            'busi_designation_others' => 'Designation Others',
            'busi_nature_of_business' => 'Nature Of Business',
            'busi_staff_declared' => 'Staff Declared',
            'busi_staff_seen' => 'Staff Seen',
            'busi_years_in_business' => 'Years In Business',
            'busi_type_of_business' => 'Type Of Business',
            'busi_ownership_status' => 'Ownership Status',
            'busi_ownership_status_text' => 'Ownership Status Text',
            'busi_area' => 'Area',
            'busi_locality' => 'Locality',
            'busi_locality_text' => 'Locality Other',
            'busi_locality_type' => 'Locality Type',
            'busi_landmark_1' => 'Landmark 1',
            'busi_landmark_2' => 'Landmark 2',
            'busi_activity_seen' => 'Activity Seen',
            'busi_structure' => 'Structure',
            'busi_remarks' => 'Remarks',
            'busi_status' => 'Status',
            'busi_is_reachable' => 'Is Reachable',
            'busi_not_reachable_remarks' => 'Not Reachable Remarks',
            'busi_rented_owner_name' => 'Rented Owner Name',
            'busi_rent_amount' => 'Rent Amount',
            'busi_available_status' => 'Available Status',
            'busi_shifted_tenure' => 'Shifted Tenure',
            'busi_reason_for_closed' => 'Reason For Closed',
            'busi_address' => 'Address',
            'busi_address_verification' => 'Address Verification',
            'busi_address_pincode' => 'Address Pincode',
            'busi_address_trigger' => 'Address Trigger',
            'busi_address_lat' => 'Address Lat',
            'busi_address_long' => 'Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (isset($this->id)) {
                $this->updated_on = date("Y-m-d H:i:s");
                $this->updated_by = Yii::$app->user->id;
            } else {
                $this->created_on = date("Y-m-d H:i:s");
                $this->created_by = Yii::$app->user->id;
            }
            
            return true;
        }

        return FALSE;
    }

}
