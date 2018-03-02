<?php

namespace mdm\admin\controllers;

use Yii;
use mdm\admin\models\form\Login;
use mdm\admin\models\form\PasswordResetRequest;
use mdm\admin\models\form\ResetPassword;
use mdm\admin\models\form\Signup;
use mdm\admin\models\form\ChangePassword;
use mdm\admin\models\User;
use mdm\admin\models\UserDetails;
use mdm\admin\models\searchs\User as UserSearch;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use app\components\BaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;
use mdm\admin\components\Helper;
use app\modules\applications\models\Institutes;
use app\modules\applications\models\LoanTypes;

/**
 * User controller
 */
class UserController extends BaseController {

    private $_oldMailPath;
    public $leftMenuGroup = 'settings';

    //public $layout = '//adminlte-default';

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'logout' => ['post'],
                    'activate' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action) {
        if (parent::beforeAction($action)) {
            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
                /* @var $mailer BaseMailer */
                $this->_oldMailPath = $mailer->getViewPath();
                $mailer->setViewPath('@mdm/admin/mail');
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result) {
        if ($this->_oldMailPath !== null) {
            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
        }
        return parent::afterAction($action, $result);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id = FALSE) {
        #Find User Routes
        $currentUserRoutes = array_keys(Helper::getRoutesByUser(Yii::$app->user->id));
        $userDetails = UserDetails::findOne(['user_id' => Yii::$app->user->id]);
        if (empty($userDetails)) {
            $userDetails = UserDetails::updateUserDetails();
        }
        $model = User::find()->where(['id' => Yii::$app->user->id])->with('userDetails')->one();
        #Update User Info by Admin or /*
        if (!empty($id) && (in_array("/*", $currentUserRoutes) || in_array("/admin/user/index", $currentUserRoutes))) {
            $userDetails = UserDetails::findOne(['user_id' => $id]);
            if (empty($userDetails)) {
                $userDetails = new UserDetails();
                $userDetails->user_id = $id;
                $userDetails->save(FALSE);
            }
            $model = User::find()->where(['id' => $id])->with('userDetails')->one();
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Login
     * @return string
     */
    public function actionLogin() {
        $this->layout = '//main-login';
        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            #Update User Details if not created
            $userDetails = UserDetails::findOne(['user_id' => Yii::$app->user->id]);
            if (empty($userDetails)) {
                $userDetails = UserDetails::updateUserDetails();
            } else {
                $userDetails->last_login_time = $userDetails->current_login_time;
                $userDetails->current_login_time = date("Y-m-d H:i:s");
                $userDetails->last_login_ip = $userDetails->current_login_ip;
                $userDetails->current_login_ip = Yii::$app->request->getUserIP();
                $userDetails->update(FALSE);
            }
            $url = Yii::$app->getUser()->getReturnUrl();
            if (preg_match("/user\/logout/", $url)) {
                return $this->goHome();
            }
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout
     * @return string
     */
    public function actionLogout() {
        Yii::$app->getUser()->logout();

        return $this->goHome();
    }

    /**
     * Signup new user
     * @return string
     */
    public function actionSignup() {
        $this->layout = '//main-login';
        if (!empty(Yii::$app->user->id)) {
            return $this->goHome();
        }
        $model = new Signup();
        $userDetailsmodel = new UserDetails;
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                $userDetailsmodel->load(Yii::$app->getRequest()->post());
                $userDetailsmodel->user_id = $user->id;
                $userDetailsmodel->current_login_time = date("Y-m-d H:i:s");
                $userDetailsmodel->last_login_time = date("Y-m-d H:i:s");
                $userDetailsmodel->current_login_ip = Yii::$app->request->getUserIP();
                $userDetailsmodel->last_login_ip = Yii::$app->request->getUserIP();
                $userDetailsmodel->save(FALSE);
                return $this->goHome();
            }
        }

        return $this->render('signup', [
                    'model' => $model,
                    'userDetails' => $userDetailsmodel,
        ]);
    }

    /**
     * Request reset password
     * @return string
     */
    public function actionRequestPasswordReset() {
        $this->layout = '//main-login';
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionChangePassword() {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change()) {
            Yii::$app->session->setFlash('success', 'Password change successfully.');
            return $this->redirect('change-password');
        }

        return $this->render('change-password', [
                    'model' => $model,
        ]);
    }

    /**
     * Activate new user
     * @param integer $id
     * @return type
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function actionActivate($id) {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_INACTIVE) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                return $this->goHome();
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->goHome();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionUpdate($id = FALSE) {
        #Find User Routes
        $currentUserRoutes = array_keys(Helper::getRoutesByUser(Yii::$app->user->id));

        $model = $this->findModel(Yii::$app->user->id);
        $userDetails = UserDetails::findOne(['user_id' => Yii::$app->user->id]);
        if (empty($userDetails)) {
            $userDetails = UserDetails::updateUserDetails();
        }
        #Update User Info by Admin or /*
        if (!empty($id) && (in_array("/*", $currentUserRoutes) || in_array("/admin/user/index", $currentUserRoutes))) {
            $userDetails = UserDetails::findOne(['user_id' => $id]);
            if (empty($userDetails)) {
                $userDetails = new UserDetails();
                $userDetails->user_id = $id;
                $userDetails->save(FALSE);
            }
            $model = $this->findModel($id);
        }

        if ($userDetails->load(Yii::$app->request->post())) {
            if ($userDetails->update(FALSE)) {
                return $this->render('view', [
                            'model' => $model,
                            'userDetails' => $userDetails,
                ]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
                    'userDetails' => $userDetails,
        ]);
    }

    /**
     * Signup new user
     * @return string
     */
    public function actionCreate() {
        $model = new Signup();
        $userDetailsmodel = new UserDetails;
        $institutes = new Institutes();
        $LoanTypes = new LoanTypes();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                $userDetailsmodel->load(Yii::$app->getRequest()->post());
                $userDetailsmodel->user_id = $user->id;
                $userDetailsmodel->current_login_time = date("Y-m-d H:i:s");
                $userDetailsmodel->last_login_time = date("Y-m-d H:i:s");
                $userDetailsmodel->current_login_ip = Yii::$app->request->getUserIP();
                $userDetailsmodel->last_login_ip = Yii::$app->request->getUserIP();
                $userDetailsmodel->save(FALSE);
                return $this->redirect('index');
            }
        }

        return $this->render('signup', [
                    'model' => $model,
                    'userDetails' => $userDetailsmodel,
                    'institutes' => $institutes,
                    'LoanTypes' => $LoanTypes,
        ]);
    }

    public function actionManagePassword() {
        $userModel = new User();
        $changeModel = new ChangePassword();
        $model = new UserDetails(['scenario' => 'changePassword']);
        $sql = "SELECT u.id, CONCAT(ud.first_name, ' ', ud.last_name) as username FROM user u INNER JOIN tbl_user_details ud ON ud.user_id = u.id ORDER BY username";
        $userData = \Yii::$app->db->createCommand($sql)->queryAll();
        if ($model->load(\Yii::$app->request->post())) {
            if (!empty($model->user_id)) {
                $userModel = User::find()->where(['id' => $model->user_id])->with('userDetails')->one();
            }
            if (!empty(\Yii::$app->request->post('ChangePassword'))) {
                $changeModel->newPassword = \Yii::$app->request->post('ChangePassword')['newPassword'];
                if (!empty($changeModel->newPassword)) {
                    $user = User::findOne(["id" => $model->user_id]);
                    $user->setPassword($changeModel->newPassword);
                    $user->generateAuthKey();
                    if ($user->save()) {
                        Yii::$app->session->setFlash('success', 'Password change successfully.');
                        return $this->redirect("manage-password");
                    }
                }
            }
        }
        return $this->render("manage_password", [
                    "model" => $model,
                    "userModel" => $userModel,
                    "userData" => $userData,
                    "changeModel" => $changeModel,
        ]);
    }

}
