<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_loan_types".
 *
 * @property integer $id
 * @property string $loan_name
 * @property integer $loan_type
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class LoanTypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_loan_types';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_name', 'loan_type'], 'required'],
            [['loan_type', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['loan_name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_name' => 'Loan Name',
            'loan_type' => 'Loan Type',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
    
    public function getLoanType($loan_type) {
        $return = '';

        switch ($loan_type) {
            case 1:
                $return = 'ASSET VERIFICATION';
                break;
            case 2:
                $return = 'LIABILITIES VERIFICATION';
                break;
            case 3:
                $return = 'VENDOR VERIFICATION';
                break;        
        }

        return $return;
    }
}
