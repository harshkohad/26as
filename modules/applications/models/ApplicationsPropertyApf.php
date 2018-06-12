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
 */
class ApplicationsPropertyApf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_property_apf';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'property_apf_property_status', 'property_apf_no_of_workers', 'property_apf_total_flats', 'property_apf_how_many_sold', 'property_apf_total_shops', 'property_apf_area', 'property_apf_is_reachable', 'property_apf_address_verification'], 'integer'],
            [['property_apf_not_reachable_remarks'], 'string'],
            [['property_apf_met_person', 'property_apf_met_person_designation', 'property_apf_mode_of_payment', 'property_apf_construction_stock', 'property_apf_work_completed', 'property_apf_possession', 'property_apf_apf', 'property_apf_delay_in_work', 'property_apf_tpc', 'property_apf_landmark'], 'string', 'max' => 150],
            [['property_apf_address', 'property_apf_address_trigger'], 'string', 'max' => 1000],
            [['property_apf_address_pincode'], 'string', 'max' => 10],
            [['property_apf_address_lat', 'property_apf_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'property_apf_met_person' => 'Property Apf Met Person',
            'property_apf_met_person_designation' => 'Property Apf Met Person Designation',
            'property_apf_property_status' => 'Property Apf Property Status',
            'property_apf_no_of_workers' => 'Property Apf No Of Workers',
            'property_apf_mode_of_payment' => 'Property Apf Mode Of Payment',
            'property_apf_construction_stock' => 'Property Apf Construction Stock',
            'property_apf_total_flats' => 'Property Apf Total Flats',
            'property_apf_how_many_sold' => 'Property Apf How Many Sold',
            'property_apf_total_shops' => 'Property Apf Total Shops',
            'property_apf_area' => 'Property Apf Area',
            'property_apf_work_completed' => 'Property Apf Work Completed',
            'property_apf_possession' => 'Property Apf Possession',
            'property_apf_apf' => 'Property Apf Apf',
            'property_apf_delay_in_work' => 'Property Apf Delay In Work',
            'property_apf_tpc' => 'Property Apf Tpc',
            'property_apf_landmark' => 'Property Apf Landmark',
            'property_apf_is_reachable' => 'Property Apf Is Reachable',
            'property_apf_not_reachable_remarks' => 'Property Apf Not Reachable Remarks',
            'property_apf_address' => 'Property Apf Address',
            'property_apf_address_verification' => 'Property Apf Address Verification',
            'property_apf_address_pincode' => 'Property Apf Address Pincode',
            'property_apf_address_trigger' => 'Property Apf Address Trigger',
            'property_apf_address_lat' => 'Property Apf Address Lat',
            'property_apf_address_long' => 'Property Apf Address Long',
        ];
    }
}
