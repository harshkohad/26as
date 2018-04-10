<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_notifications".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $message
 * @property integer $is_unread
 * @property integer $application_id
 * @property string $notification_created_at
 * @property integer $created_by
 * @property string $created_on
 * @property integer $updated_by
 * @property string $updated_on
 * @property integer $is_deleted
 */
class Notifications extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_notifications';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id', 'user_id', 'is_unread', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['message'], 'string'],
            [['application_id', 'notification_created_at', 'created_on', 'updated_on'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'message' => 'Message',
            'is_unread' => 'Is Unread',
            'application_id' => 'Application Id',
            'notification_created_at' => 'Notification Created At',
            'created_by' => 'Created By',
            'created_on' => 'Created On',
            'updated_by' => 'Updated By',
            'updated_on' => 'Updated On',
            'is_deleted' => 'Is Deleted',
        ];
    }
}
