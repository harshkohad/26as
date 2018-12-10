<?php

namespace app\modules\request\controllers;

use Yii;
use app\modules\request\models\Request;
use app\modules\request\models\RequestSearch;

class ProcessController extends \yii\web\Controller
{
    /**
     * Lists all Request models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

}
