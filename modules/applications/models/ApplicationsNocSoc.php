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
            [['application_id', 'noc_soc_society_type', 'noc_soc_is_reachable', 'noc_soc_address_verification'], 'integer'],
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
            'noc_soc_chairman_name' => 'Noc Soc Chairman Name',
            'noc_soc_secretary_name' => 'Noc Soc Secretary Name',
            'noc_soc_tresurer_name' => 'Noc Soc Tresurer Name',
            'noc_soc_met_person' => 'Noc Soc Met Person',
            'noc_soc_met_person_designation' => 'Noc Soc Met Person Designation',
            'noc_soc_signature_done_by' => 'Noc Soc Signature Done By',
            'noc_soc_bldg_reg_number' => 'Noc Soc Bldg Reg Number',
            'noc_soc_society_type' => 'Noc Soc Society Type',
            'noc_soc_previous_owner' => 'Noc Soc Previous Owner',
            'noc_soc_is_reachable' => 'Noc Soc Is Reachable',
            'noc_soc_not_reachable_remarks' => 'Noc Soc Not Reachable Remarks',
            'noc_soc_address' => 'Noc Soc Address',
            'noc_soc_address_verification' => 'Noc Soc Address Verification',
            'noc_soc_address_pincode' => 'Noc Soc Address Pincode',
            'noc_soc_address_trigger' => 'Noc Soc Address Trigger',
            'noc_soc_address_lat' => 'Noc Soc Address Lat',
            'noc_soc_address_long' => 'Noc Soc Address Long',
        ];
    }
}
