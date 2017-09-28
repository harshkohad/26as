<?php

namespace mdm\admin\models\searchs;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AssignmentSearch represents the model behind the search form about Assignment.
 * 
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class Assignment extends Model {

    public $id;
    public $username;
    public $first_name;
    public $last_name;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id', 'username', 'first_name', 'last_name'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('rbac-admin', 'ID'),
            'username' => Yii::t('rbac-admin', 'Username'),
            'name' => Yii::t('rbac-admin', 'Name'),
        ];
    }

    /**
     * Create data provider for Assignment model.
     * @param  array                        $params
     * @param  \yii\db\ActiveRecord         $class
     * @param  string                       $usernameField
     * @return \yii\data\ActiveDataProvider
     */
    public function search($params, $class, $usernameField) {
        $currentUserRoutes = array_keys(\mdm\admin\components\Helper::getRoutesByUser(Yii::$app->user->id));
        $manager = Yii::$app->getAuthManager();
        $routeDetails = $manager->getPermission("/*");
        if (in_array($routeDetails->name, $currentUserRoutes)) {
            $query = $class::find()->alias('u')->select(['u.id', 'u.username', 'ud.first_name', 'ud.last_name'])
                    ->join("INNER JOIN", "tbl_user_details as ud", "ud.user_id = u.id");
        } else {
            $query = $class::find()->alias('u')->select(['u.id', 'u.username', 'ud.first_name', 'ud.last_name'])
                    ->join("INNER JOIN", "tbl_user_details as ud", "ud.user_id = u.id")
                    ->where("u.username NOT IN (SELECT parent FROM auth_item_child WHERE child = '$routeDetails->name' GROUP BY parent)");
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', "u." . $usernameField, $this->username]);
        $query->andFilterWhere(['like', "ud.first_name", $this->first_name]);
        $query->andFilterWhere(['like', "ud.last_name", $this->last_name]);

        return $dataProvider;
    }

}
