<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_noc_soc".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $noc_soc_chairman_name
 * @property string $noc_soc_secretary_name
 * @property string $noc_soc_tresurer_name
 * @property string $noc_soc_met_person
 * @property string $noc_soc_met_person_designation
 * @property string $noc_soc_signature_done_by
 * @property string $noc_soc_bldg_reg_number
 * @property integer $noc_soc_society_type
 * @property string $noc_soc_previous_owner
 * @property integer $noc_soc_is_reachable
 * @property string $noc_soc_not_reachable_remarks
 * @property string $noc_soc_address
 * @property integer $noc_soc_address_verification
 * @property string $noc_soc_address_pincode
 * @property string $noc_soc_address_trigger
 * @property string $noc_soc_address_lat
 * @property string $noc_soc_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsNocSoc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_noc_soc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'noc_soc_society_type', 'noc_soc_is_reachable', 'noc_soc_address_verification', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['noc_soc_not_reachable_remarks'], 'string'],
            [['noc_soc_chairman_name', 'noc_soc_secretary_name', 'noc_soc_tresurer_name'], 'string', 'max' => 200],
            [['noc_soc_met_person', 'noc_soc_met_person_designation', 'noc_soc_signature_done_by', 'noc_soc_bldg_reg_number', 'noc_soc_previous_owner'], 'string', 'max' => 150],
            [['noc_soc_address', 'noc_soc_address_trigger'], 'string', 'max' => 1000],
            [['noc_soc_address_pincode'], 'string', 'max' => 10],
            [['noc_soc_address_lat', 'noc_soc_address_long'], 'string', 'max' => 45],
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
            'noc_soc_chairman_name' => 'Chairman Name',
            'noc_soc_secretary_name' => 'Secretary Name',
            'noc_soc_tresurer_name' => 'Tresurer Name',
            'noc_soc_met_person' => 'Met Person',
            'noc_soc_met_person_designation' => 'Met Person Designation',
            'noc_soc_signature_done_by' => 'Signature Done By',
            'noc_soc_bldg_reg_number' => 'Bldg Reg Number',
            'noc_soc_society_type' => 'Society Type',
            'noc_soc_previous_owner' => 'Previous Owner',
            'noc_soc_is_reachable' => 'Is Reachable',
            'noc_soc_not_reachable_remarks' => 'Not Reachable Remarks',
            'noc_soc_address' => 'Address',
            'noc_soc_address_verification' => 'Address Verification',
            'noc_soc_address_pincode' => 'Address Pincode',
            'noc_soc_address_trigger' => 'Address Trigger',
            'noc_soc_address_lat' => 'Address Lat',
            'noc_soc_address_long' => 'Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
