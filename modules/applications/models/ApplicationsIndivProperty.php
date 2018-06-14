<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_indiv_property".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $indiv_property_met_person
 * @property string $indiv_property_met_person_designation
 * @property string $indiv_property_property_confirmed
 * @property string $indiv_property_previous_owner
 * @property integer $indiv_property_property_type
 * @property integer $indiv_property_area
 * @property string $indiv_property_approx_market_value
 * @property string $indiv_property_society_name_plate
 * @property string $indiv_property_door_name_plate
 * @property string $indiv_property_tpc
 * @property string $indiv_property_landmark
 * @property integer $indiv_property_is_reachable
 * @property string $indiv_property_not_reachable_remarks
 * @property string $indiv_property_address
 * @property integer $indiv_property_address_verification
 * @property string $indiv_property_address_pincode
 * @property string $indiv_property_address_trigger
 * @property string $indiv_property_address_lat
 * @property string $indiv_property_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsIndivProperty extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'tbl_applications_indiv_property';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['application_id'], 'required'],
            [['application_id', 'indiv_property_property_type', 'indiv_property_area', 'indiv_property_is_reachable', 'indiv_property_address_verification', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['indiv_property_not_reachable_remarks'], 'string'],
            [['indiv_property_met_person', 'indiv_property_met_person_designation', 'indiv_property_property_confirmed', 'indiv_property_previous_owner', 'indiv_property_approx_market_value', 'indiv_property_society_name_plate', 'indiv_property_door_name_plate', 'indiv_property_tpc', 'indiv_property_landmark'], 'string', 'max' => 150],
            [['indiv_property_address', 'indiv_property_address_trigger'], 'string', 'max' => 1000],
            [['indiv_property_address_pincode'], 'string', 'max' => 10],
            [['indiv_property_address_lat', 'indiv_property_address_long'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'indiv_property_met_person' => 'Indiv Property Met Person',
            'indiv_property_met_person_designation' => 'Indiv Property Met Person Designation',
            'indiv_property_property_confirmed' => 'Indiv Property Property Confirmed',
            'indiv_property_previous_owner' => 'Indiv Property Previous Owner',
            'indiv_property_property_type' => 'Indiv Property Property Type',
            'indiv_property_area' => 'Indiv Property Area',
            'indiv_property_approx_market_value' => 'Indiv Property Approx Market Value',
            'indiv_property_society_name_plate' => 'Indiv Property Society Name Plate',
            'indiv_property_door_name_plate' => 'Indiv Property Door Name Plate',
            'indiv_property_tpc' => 'Indiv Property Tpc',
            'indiv_property_landmark' => 'Indiv Property Landmark',
            'indiv_property_is_reachable' => 'Indiv Property Is Reachable',
            'indiv_property_not_reachable_remarks' => 'Indiv Property Not Reachable Remarks',
            'indiv_property_address' => 'Indiv Property Address',
            'indiv_property_address_verification' => 'Indiv Property Address Verification',
            'indiv_property_address_pincode' => 'Indiv Property Address Pincode',
            'indiv_property_address_trigger' => 'Indiv Property Address Trigger',
            'indiv_property_address_lat' => 'Indiv Property Address Lat',
            'indiv_property_address_long' => 'Indiv Property Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if (isset($this->id)) {
                $this->updated_on = date("Y-m-d H:i:s");
                $this->update_by = Yii::$app->user->id;
            } else {
                $this->created_on = date("Y-m-d H:i:s");
                $this->created_by = Yii::$app->user->id;
            }

            return true;
        }

        return FALSE;
    }

}
