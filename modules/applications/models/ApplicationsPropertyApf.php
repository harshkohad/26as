<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_property_apf".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $property_apf_met_person
 * @property string $property_apf_met_person_designation
 * @property integer $property_apf_property_status
 * @property integer $property_apf_no_of_workers
 * @property string $property_apf_mode_of_payment
 * @property string $property_apf_construction_stock
 * @property integer $property_apf_total_flats
 * @property integer $property_apf_how_many_sold
 * @property integer $property_apf_total_shops
 * @property integer $property_apf_area
 * @property string $property_apf_work_completed
 * @property string $property_apf_possession
 * @property string $property_apf_apf
 * @property string $property_apf_delay_in_work
 * @property string $property_apf_tpc
 * @property string $property_apf_landmark
 * @property integer $property_apf_is_reachable
 * @property string $property_apf_not_reachable_remarks
 * @property string $property_apf_address
 * @property integer $property_apf_address_verification
 * @property string $property_apf_address_pincode
 * @property string $property_apf_address_trigger
 * @property string $property_apf_address_lat
 * @property string $property_apf_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsPropertyApf extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_property_apf';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id'], 'required'],
            [['application_id', 'property_apf_property_status', 'property_apf_no_of_workers', 'property_apf_total_flats', 'property_apf_how_many_sold', 'property_apf_total_shops', 'property_apf_area', 'property_apf_is_reachable', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['property_apf_not_reachable_remarks'], 'string'],
            [['property_apf_met_person', 'property_apf_met_person_designation', 'property_apf_mode_of_payment', 'property_apf_construction_stock', 'property_apf_work_completed', 'property_apf_possession', 'property_apf_apf', 'property_apf_delay_in_work', 'property_apf_tpc', 'property_apf_landmark'], 'string', 'max' => 150],
            [['property_apf_address', 'property_apf_address_trigger'], 'string', 'max' => 1000],
            [['property_apf_address_pincode'], 'string', 'max' => 10],
            //[['property_apf_address_lat', 'property_apf_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'property_apf_met_person' => 'Met Person',
            'property_apf_met_person_designation' => 'Met Person Designation',
            'property_apf_property_status' => 'Property Status',
            'property_apf_no_of_workers' => 'No Of Workers',
            'property_apf_mode_of_payment' => 'Mode Of Payment',
            'property_apf_construction_stock' => 'Construction Stock',
            'property_apf_total_flats' => 'Total Flats',
            'property_apf_how_many_sold' => 'How Many Sold',
            'property_apf_total_shops' => 'Total Shops',
            'property_apf_area' => 'Area',
            'property_apf_work_completed' => 'Work Completed',
            'property_apf_possession' => 'Possession',
            'property_apf_apf' => 'Apf',
            'property_apf_delay_in_work' => 'Delay In Work',
            'property_apf_tpc' => 'Tpc',
            'property_apf_landmark' => 'Landmark',
            'property_apf_is_reachable' => 'Is Reachable',
            'property_apf_not_reachable_remarks' => 'Not Reachable Remarks',
            'property_apf_address' => 'Address',
            'property_apf_address_verification' => 'Address Verification',
            'property_apf_address_pincode' => 'Address Pincode',
            'property_apf_address_trigger' => 'Address Trigger',
            'property_apf_address_lat' => 'Address Lat',
            'property_apf_address_long' => 'Address Long',
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
