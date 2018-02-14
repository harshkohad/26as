<?php

namespace app\modules\applications\models;

use Yii;

/**
 * This is the model class for table "tbl_institutes".
 *
 * @property integer $id
 * @property string $name
 * @property integer $download_pdf
 * @property integer $download_excel
 * @property integer $char_count
 * @property integer $is_alphanumeric
 * @property string $file_name
 * @property integer $is_active
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class Institutes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_institutes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['download_pdf', 'download_excel', 'char_count', 'is_alphanumeric', 'is_active', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['file_name'], 'string', 'max' => 1000],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Institute Name',
            'download_pdf' => 'Download Pdf',
            'download_excel' => 'Download Excel',
            'char_count' => 'Char Count',
            'is_alphanumeric' => 'Is Alphanumeric',
            'file_name' => 'File Name',
            'is_active' => 'Is Active',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
