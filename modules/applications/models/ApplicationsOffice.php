<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_applications_office".
 *
 * @property integer $id
 * @property integer $application_id
 * @property string $office_reason_for_closed
 * @property string $office_company_name_board
 * @property string $office_designation
 * @property string $office_met_person
 * @property string $office_met_person_designation
 * @property string $office_department
 * @property string $office_nature_of_company
 * @property integer $office_employment_years
 * @property string $office_net_salary_amount
 * @property string $office_tpc_for_applicant
 * @property string $office_tpc_for_company
 * @property string $office_landmark
 * @property string $office_structure
 * @property string $office_remarks
 * @property integer $office_status
 * @property integer $office_is_reachable
 * @property string $office_not_reachable_remarks
 * @property integer $office_available_status
 * @property integer $office_shifted_tenure
 * @property string $office_address
 * @property integer $office_address_verification
 * @property string $office_address_pincode
 * @property string $office_address_trigger
 * @property string $office_address_lat
 * @property string $office_address_long
 * @property integer $created_by
 * @property string $created_on
 * @property integer $update_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class ApplicationsOffice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_applications_office';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application_id'], 'required'],
            [['application_id', 'office_employment_years', 'office_status', 'office_is_reachable', 'office_available_status', 'office_shifted_tenure', 'office_address_verification', 'created_by', 'update_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['office_not_reachable_remarks'], 'string'],
            [['office_reason_for_closed'], 'string', 'max' => 100],
            [['office_company_name_board', 'office_designation', 'office_met_person', 'office_met_person_designation', 'office_department', 'office_nature_of_company', 'office_net_salary_amount', 'office_tpc_for_applicant', 'office_tpc_for_company', 'office_landmark'], 'string', 'max' => 150],
            [['office_structure', 'office_remarks', 'office_address', 'office_address_trigger'], 'string', 'max' => 1000],
            [['office_address_pincode'], 'string', 'max' => 10],
            [['office_address_lat', 'office_address_long'], 'string', 'max' => 45],
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
            'office_reason_for_closed' => 'Office Reason For Closed',
            'office_company_name_board' => 'Office Company Name Board',
            'office_designation' => 'Office Designation',
            'office_met_person' => 'Office Met Person',
            'office_met_person_designation' => 'Office Met Person Designation',
            'office_department' => 'Office Department',
            'office_nature_of_company' => 'Office Nature Of Company',
            'office_employment_years' => 'Office Employment Years',
            'office_net_salary_amount' => 'Office Net Salary Amount',
            'office_tpc_for_applicant' => 'Office Tpc For Applicant',
            'office_tpc_for_company' => 'Office Tpc For Company',
            'office_landmark' => 'Office Landmark',
            'office_structure' => 'Office Structure',
            'office_remarks' => 'Office Remarks',
            'office_status' => 'Office Status',
            'office_is_reachable' => 'Office Is Reachable',
            'office_not_reachable_remarks' => 'Office Not Reachable Remarks',
            'office_available_status' => 'Office Available Status',
            'office_shifted_tenure' => 'Office Shifted Tenure',
            'office_address' => 'Office Address',
            'office_address_verification' => 'Office Address Verification',
            'office_address_pincode' => 'Office Address Pincode',
            'office_address_trigger' => 'Office Address Trigger',
            'office_address_lat' => 'Office Address Lat',
            'office_address_long' => 'Office Address Long',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'update_by' => 'Update By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
