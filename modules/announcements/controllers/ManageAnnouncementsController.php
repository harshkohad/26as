<?php

namespace app\modules\announcements\controllers;

use Yii;
use app\models\Notifications;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class ManageAnnouncementsController extends \yii\web\Controller {

    public function actionManageNotifications() {
        $model = new Notifications();
        $query = Notifications::find();
        $query->andFilterWhere([
            'type' => 0
        ]);
        $data = $query->all();
        return $this->render('/announcements/manage-notifications', [
                    'data' => $data,
                    'label' => "Notifications",
        ]);
    }

    public function actionManageAlerts() {
        $model = new Notifications();
        $query = Notifications::find();
        $query->andFilterWhere([
            'type' => 1
        ]);
        $data = $query->all();
        return $this->render('/announcements/manage-notifications', [
                    'data' => $data,
                    'label' => "Alerts",
        ]);
    }

    /**
     * Displays a single ApplicantProfile model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ApplicantProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ApplicantProfile();
        $model->created_on = date("Y-m-d H:i:s");

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ApplicantProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ApplicantProfile model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ApplicantProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return ApplicantProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ApplicantProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
