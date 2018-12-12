<?php

namespace app\modules\request\models;

use Yii;
use app\modules\request\models\AssessmentYearDetails;

/**
 * This is the model class for table "tbl_itr_request".
 *
 * @property int $id
 * @property string $pan_card_number
 * @property int $itr_request_status 0 - new, 1 - inprogress, 2 = completed
 * @property string $assessment_years
 * @property string $unique_id
 * @property string $created_at
 * @property int $created_by
 * @property string $updated_at
 * @property int $updated_by
 * @property int $is_deleted 0 > active, 1 > deleted
 */
class Request extends \yii\db\ActiveRecord
{
    const IMG_UPLOAD_DIR_NAME = "uploads/26as/";
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_itr_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['itr_request_status', 'created_by', 'updated_by', 'is_deleted'], 'integer'],
            [['pan_card_number', 'assessment_years'], 'required'],
            [['assessment_years'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['pan_card_number', 'unique_id'], 'string', 'max' => 45],
            ['pan_card_number', 'validatePanCard'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pan_card_number' => 'Pan Card',
            'itr_request_status' => 'Status',
            'assessment_years' => 'Assessment Years',
            'unique_id' => 'Unique ID',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
            'is_deleted' => 'Is Deleted',
        ];
    }
    
    public function validatePanCard($attribute, $params) {
        $pattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
        if (!empty($this->pan_card_number)) {
            $result = preg_match($pattern, $this->pan_card_number);
            if ($result) {
                $findme = ucfirst(substr($this->pan_card_number, 3, 1));
                $mystring = 'CPHFATBLJG';
                $pos = strpos($mystring, $findme);
                if ($pos === false) {
                    $this->addError($attribute, 'Invalid Pan Card.');
                    return FALSE;
                }
            } else {
                $this->addError($attribute, 'Invalid Pan Card.');
                return FALSE;
            }
        }
    }
    
    public function getRandomUniqueId($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    public function getApplicationStatus($id, $itr_request_status) {
        $return = '';
        switch ($itr_request_status) {
            case 0:
                $return = '<span style="color:#3c8dbc;font-weight:bold">New</span>';
                break;
            case 1:
                $return = '<span style="color:#d58512;font-weight:bold">Inprogress</span>';
                break;
            case 2:
                $return = '<span style="color:#00a65a;font-weight:bold">Completed</span>';
                break;
        }
        return $return;
    }
    
    public function getImgThumbs($request_id, $assessment_year) {
        $model = Request::findOne($request_id); 
        $return_html = '';
        $return_html_sub = '';
        if(!empty($model)) {
            $asImages = AssessmentYearDetails::find()->where(['itr_request_id' => $request_id, 'assessment_year' => $assessment_year, 'is_deleted' => '0'])->all();
            if(!empty($asImages)) {
                foreach ($asImages as $asImage) {                    
                    $image_link = '<a href="#" class="pop_kyc"><img src="' . Yii::$app->request->BaseUrl . '/' . self::IMG_UPLOAD_DIR_NAME . $model->unique_id . '/thumbs/' . $asImage['image_url'] . '" class="user-image" alt="AS Image" width="100"></a>';
                    $return_html_sub .= '<li>';
                    $return_html_sub .= '<div class="row" style="padding-bottom: 10px;">';
                    $return_html_sub .= '<div class="col-lg-2">'.$image_link.'</div>';
                    $return_html_sub .= '<div class="col-lg-6">'.$asImage['remarks'].'</div>';
                    $return_html_sub .= '</div>';
                    $return_html_sub .= '</li>';
                }
                if(!empty($return_html_sub)) {
                    $return_html = '<ul class="nav nav-pills nav-stacked labels-info " style="border-bottom : none !important;">';
                    $return_html .= $return_html_sub;
                    $return_html .= '</ul>';
                }
            }
        }
        return $return_html;
    }
    
    function thumbnailCreator($newfile_name, $dirname, $thumbs_folder_name, $thumb_width, $thumb_height) {
        $file_ext = pathinfo($newfile_name, PATHINFO_EXTENSION);
        //upload image path
        $upload_image = $dirname . '/' . $newfile_name;

        $thumbnail = $dirname . '/' . $thumbs_folder_name . '/' . $newfile_name;
        list($width, $height) = getimagesize($upload_image);
        $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
        switch ($file_ext) {
            case 'jpg':
                $source = imagecreatefromjpeg($upload_image);
                break;
            case 'jpeg':
                $source = imagecreatefromjpeg($upload_image);
                break;
            case 'png':
                $source = imagecreatefrompng($upload_image);
                break;
            case 'gif':
                $source = imagecreatefromgif($upload_image);
                break;
            default:
                $source = imagecreatefromjpeg($upload_image);
        }

        imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        switch ($file_ext) {
            case 'jpg' || 'jpeg':
                imagejpeg($thumb_create, $thumbnail, 100);
                break;
            case 'png':
                imagepng($thumb_create, $thumbnail, 100);
                break;

            case 'gif':
                imagegif($thumb_create, $thumbnail, 100);
                break;
            default:
                imagejpeg($thumb_create, $thumbnail, 100);
        }
    }    
    
    public function getStatusCount($status) {
        echo Request::find()->where(['itr_request_status' => $status])->count();
    }
}
