<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_resi".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $resi_society_name_plate
 * @property string $resi_door_name_plate
 * @property string $resi_tpc_neighbor_1
 * @property string $resi_tpc_neighbor_2
 * @property string $resi_met_person
 * @property string $resi_relation
 * @property integer $resi_home_area
 * @property integer $resi_ownership_status
 * @property string $resi_ownership_status_text
 * @property integer $resi_stay_years
 * @property integer $resi_total_family_members
 * @property integer $resi_working_members
 * @property integer $resi_locality
 * @property string $resi_locality_text
 * @property integer $resi_locality_type
 * @property string $resi_landmark_1
 * @property string $resi_landmark_2
 * @property string $resi_structure
 * @property integer $resi_market_feedback
 * @property string $resi_remarks
 * @property integer $resi_status
 * @property integer $resi_is_reachable
 * @property string $resi_not_reachable_remarks
 * @property string $resi_rented_owner_name
 * @property string $resi_rent_amount
 * @property integer $resi_available_status
 * @property integer $resi_shifted_tenure
 * @property string $resi_address
 * @property integer $resi_address_verification
 * @property string $resi_address_pincode
 * @property string $resi_address_trigger
 * @property string $resi_address_lat
 * @property string $resi_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsResi extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_resi';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id'], 'required'],
            [['application_id', 'resi_home_area', 'resi_ownership_status', 'resi_stay_years', 'resi_total_family_members', 'resi_working_members', 'resi_locality', 'resi_locality_type', 'resi_market_feedback', 'resi_status', 'resi_is_reachable', 'resi_available_status', 'resi_shifted_tenure', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on', 'resi_rent_amount', 'resi_rented_owner_name', 'resi_not_reachable_remarks', 'resi_relation', 'resi_address_pincode'], 'safe'],
            //[['resi_not_reachable_remarks'], 'string'],
            [['resi_society_name_plate', 'resi_door_name_plate', 'resi_tpc_neighbor_1', 'resi_tpc_neighbor_2', 'resi_met_person', 'resi_ownership_status_text', 'resi_locality_text', 'resi_landmark_1', 'resi_landmark_2'], 'string', 'max' => 150],
            [['resi_structure', 'resi_remarks', 'resi_address', 'resi_address_trigger'], 'string', 'max' => 1000],
            //[['resi_rented_owner_name'], 'string', 'max' => 100],
            //[['resi_rent_amount'], 'string', 'max' => 500],
            //[['resi_address_pincode'], 'string', 'max' => 10],
            //[['resi_address_lat', 'resi_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'resi_society_name_plate' => 'Society Name Plate',
            'resi_door_name_plate' => 'Door Name Plate',
            'resi_tpc_neighbor_1' => 'Tpc Neighbor 1',
            'resi_tpc_neighbor_2' => 'Tpc Neighbor 2',
            'resi_met_person' => 'Met Person',
            'resi_relation' => 'Relation',
            'resi_home_area' => 'Home Area',
            'resi_ownership_status' => 'Address type',
            'resi_ownership_status_text' => 'Address type Other',
            'resi_stay_years' => 'Stay Years',
            'resi_total_family_members' => 'Total Family Members',
            'resi_working_members' => 'Working Members',
            'resi_locality' => 'Locality',
            'resi_locality_text' => 'Locality Other',
            'resi_locality_type' => 'Locality Type',
            'resi_landmark_1' => 'Landmark 1',
            'resi_landmark_2' => 'Landmark 2',
            'resi_structure' => 'Structure',
            'resi_market_feedback' => 'Market Feedback',
            'resi_remarks' => 'Remarks',
            'resi_status' => 'Status',
            'resi_is_reachable' => 'Is Reachable',
            'resi_not_reachable_remarks' => 'Not Reachable Remarks',
            'resi_rented_owner_name' => 'Rented Owner Name',
            'resi_rent_amount' => 'Rent Amount',
            'resi_available_status' => 'Availability Status',
            'resi_shifted_tenure' => 'Shifted Tenure',
            'resi_address' => 'Address',
            'resi_address_verification' => 'Address Verification',
            'resi_address_pincode' => 'Address Pincode',
            'resi_address_trigger' => 'Address Trigger',
            'resi_address_lat' => 'Address Lat',
            'resi_address_long' => 'Address Long',
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
