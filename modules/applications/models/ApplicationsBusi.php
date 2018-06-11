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
 */
class ApplicationsBusi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_busi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'busi_staff_declared', 'busi_staff_seen', 'busi_years_in_business', 'busi_type_of_business', 'busi_ownership_status', 'busi_area', 'busi_locality', 'busi_locality_type', 'busi_activity_seen', 'busi_status', 'busi_is_reachable', 'busi_available_status', 'busi_shifted_tenure', 'busi_address_verification'], 'integer'],
            [['busi_not_reachable_remarks'], 'string'],
            [['busi_tpc_neighbor_1', 'busi_tpc_neighbor_2', 'busi_company_name_board', 'busi_met_person', 'busi_designation', 'busi_nature_of_business', 'busi_ownership_status_text', 'busi_locality_text', 'busi_landmark_1', 'busi_landmark_2'], 'string', 'max' => 150],
            [['busi_designation_others', 'busi_rented_owner_name', 'busi_reason_for_closed'], 'string', 'max' => 100],
            [['busi_structure', 'busi_remarks', 'busi_address', 'busi_address_trigger'], 'string', 'max' => 1000],
            [['busi_rent_amount'], 'string', 'max' => 500],
            [['busi_address_pincode'], 'string', 'max' => 10],
            [['busi_address_lat', 'busi_address_long'], 'string', 'max' => 45],
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
            'busi_tpc_neighbor_1' => 'Busi Tpc Neighbor 1',
            'busi_tpc_neighbor_2' => 'Busi Tpc Neighbor 2',
            'busi_company_name_board' => 'Busi Company Name Board',
            'busi_met_person' => 'Busi Met Person',
            'busi_designation' => 'Busi Designation',
            'busi_designation_others' => 'Busi Designation Others',
            'busi_nature_of_business' => 'Busi Nature Of Business',
            'busi_staff_declared' => 'Busi Staff Declared',
            'busi_staff_seen' => 'Busi Staff Seen',
            'busi_years_in_business' => 'Busi Years In Business',
            'busi_type_of_business' => 'Busi Type Of Business',
            'busi_ownership_status' => 'Busi Ownership Status',
            'busi_ownership_status_text' => 'Busi Ownership Status Text',
            'busi_area' => 'Busi Area',
            'busi_locality' => 'Busi Locality',
            'busi_locality_text' => 'Busi Locality Text',
            'busi_locality_type' => 'Busi Locality Type',
            'busi_landmark_1' => 'Busi Landmark 1',
            'busi_landmark_2' => 'Busi Landmark 2',
            'busi_activity_seen' => 'Busi Activity Seen',
            'busi_structure' => 'Busi Structure',
            'busi_remarks' => 'Busi Remarks',
            'busi_status' => 'Busi Status',
            'busi_is_reachable' => 'Busi Is Reachable',
            'busi_not_reachable_remarks' => 'Busi Not Reachable Remarks',
            'busi_rented_owner_name' => 'Busi Rented Owner Name',
            'busi_rent_amount' => 'Busi Rent Amount',
            'busi_available_status' => 'Busi Available Status',
            'busi_shifted_tenure' => 'Busi Shifted Tenure',
            'busi_reason_for_closed' => 'Busi Reason For Closed',
            'busi_address' => 'Busi Address',
            'busi_address_verification' => 'Busi Address Verification',
            'busi_address_pincode' => 'Busi Address Pincode',
            'busi_address_trigger' => 'Busi Address Trigger',
            'busi_address_lat' => 'Busi Address Lat',
            'busi_address_long' => 'Busi Address Long',
        ];
    }
}
