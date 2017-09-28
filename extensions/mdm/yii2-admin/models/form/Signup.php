<?php

namespace mdm\admin\models\form;

use mdm\admin\models\User;
use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model {

    public $username;
    public $email;
    public $password;
    protected $defaultPermission = "authenticated_user";

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => 'mdm\admin\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup() {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                #assign default permission
                $authManager = Yii::$app->authManager;
                $permission = $authManager->getPermission($this->defaultPermission);
                $authManager->assign($permission, $user->id);
                return $user;
            }
        }

        return null;
    }

}
