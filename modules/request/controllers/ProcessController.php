<?php

namespace app\modules\request\controllers;

use Yii;
use app\modules\request\models\Request;
use app\modules\request\models\RequestSearch;
use app\modules\request\models\AssessmentYearDetails;

class ProcessController extends \yii\web\Controller {

    const IMG_UPLOAD_DIR_NAME = "uploads/26as/";

    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single Request model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Request model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $imgModel = new AssessmentYearDetails();
        
        #update status
        if($model->itr_request_status == 0) {
            $model->itr_request_status = 1;
            $model->save();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
                    'imgModel' => $imgModel,
        ]);
    }

    /**
     * Finds the Request model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Request the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Request::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    /**
     * Deletes an existing Request model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionSubmitRequest() {
        if (!empty($_POST)) {
            $id = $_POST['record_id'];
            $request_model = Request::findOne($id);
            $request_model->itr_request_status = 2;
            $request_model->save();
        }
    }
    
    public function actionTempUpload() {
        $max_width = "1000";
        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg");
        $file_tmp = $_FILES['photoimg']['tmp_name'];
        $size = $_FILES['photoimg']['size'];
        $name = $_FILES['photoimg']['name'];
        $dirname = self::IMG_UPLOAD_DIR_NAME.'tmp/';
        $newfile_name = date('dmYHis') . $_FILES['photoimg']['name'];
        if (strlen($name)) {
            list($txt, $ext) = explode(".", $name);
            if (in_array($ext, $valid_formats)) {
                if ($size < (1024 * 1024)) { // Image size max 1 MB
                    $filePath = $dirname . $newfile_name;
                    if (move_uploaded_file($file_tmp, $filePath)) {
                        $width = $this->getWidth($filePath);
                        $height = $this->getHeight($filePath);
                        //Scale the image if it is greater than the width set above
                        if ($width > $max_width) {
                            $scale = $max_width / $width;
                            $uploaded = $this->resizeImage($filePath, $width, $height, $scale);
                        } else {
                            $scale = 1;
                            $uploaded = $this->resizeImage($filePath, $width, $height, $scale);
                        }
                        echo "<img id='photo' file-name='" . $newfile_name . "' class='' src='" . Yii::$app->request->baseUrl.'/'.$filePath . "' class='preview'/>";
                    }
                } else
                    echo "Image file size max 1 MB";
            } else
                echo "Invalid file format..";
        } else
            echo "Please select image..!";
        exit;
    }
    
    public function actionSaveCroppedImage() {
        $post = isset($_POST) ? $_POST: array();
        $path = self::IMG_UPLOAD_DIR_NAME.'tmp/';
        $t_width = 300; // Maximum thumbnail width
        $return_data = array();
        $return_data['status'] = 'danger';
        $return_data['msg'] = 'Something Went Wrong!!!'; 
        if(isset($_POST['t']) and $_POST['t'] == "ajax") {
            extract($_POST);
            $imagePath = $path.$_POST['image_name'];
            $imagePath_f = self::IMG_UPLOAD_DIR_NAME.$unique_id.'/'.$_POST['image_name'];
            $ratio = ($t_width/$w1); 
            $nw = ceil($w1 * $ratio);
            $nh = ceil($h1 * $ratio);
            $nimg = imagecreatetruecolor($w1,$h1);
            $im_src = imagecreatefromjpeg($imagePath);
            imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$w1,$h1,$w1,$h1);
            #save final image
            imagejpeg($nimg,$imagePath_f,90);
            #thumbnail
            $upload_img = Request::thumbnailCreator($_POST['image_name'], self::IMG_UPLOAD_DIR_NAME.$unique_id, 'thumbs', '200', '160');
            if(!empty($nimg)) {
                $this->saveImgDetails($_POST);
                $return_data['status'] = 'success';
                $return_data['msg'] = 'Successfully Uploaded!!!';
            }
        }
        return json_encode($return_data);
    }

    public function getHeight($image) {
        $sizes = getimagesize($image);
        $height = $sizes[1];
        return $height;
    }

    public function getWidth($image) {
        $sizes = getimagesize($image);
        $width = $sizes[0];
        return $width;
    }

    public function resizeImage($image, $width, $height, $scale) {
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        $source = imagecreatefromjpeg($image);
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);
        imagejpeg($newImage, $image, 90);
        chmod($image, 0777);
        return $image;
    }
    
    public function saveImgDetails($p_data) {
        $model = new AssessmentYearDetails();
        $model->itr_request_id = $p_data['request_id'];
        $model->assessment_year = $p_data['as_year'];
        $model->image_url = $p_data['image_name'];
        $model->remarks = $p_data['image_remarks'];
        $model->created_by = Yii::$app->user->id;
        $model->save();
    }
}
