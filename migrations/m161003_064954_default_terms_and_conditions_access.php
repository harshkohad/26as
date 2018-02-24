<?php

use yii\db\Migration;

class m161003_064954_default_terms_and_conditions_access extends Migration {

    public function up() {
        $allowedRoutes = [
            '/site/terms-and-conditions',
        ];
        $authManager = Yii::$app->authManager;
        $authPermission = $authManager->getPermission("authenticated_user");
        $guestPermission = $authManager->getPermission("guest_user");
        foreach ($allowedRoutes as $route) {
            $permission = $authManager->createPermission($route);
            $authManager->add($permission);
            $authManager->addChild($authPermission, $permission);
            $authManager->addChild($guestPermission, $permission);
        }
    }

    public function down() {
        echo "m161003_064954_default_terms_and_conditions_access cannot be reverted.\n";

        return false;
    }

    /*
      // Use safeUp/safeDown to run migration code within a transaction
      public function safeUp()
      {
      }

      public function safeDown()
      {
      }
     */
}
