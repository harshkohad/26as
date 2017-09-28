<?php

use yii\db\Migration;
use yii\base\InvalidConfigException;
use yii\rbac\DbManager;

class m170810_102430_add_key_user_id extends Migration {

    protected function getAuthManager() {
        $authManager = Yii::$app->getAuthManager();
        if (!$authManager instanceof DbManager) {
            throw new InvalidConfigException('You should configure "authManager" component to use database before executing this migration.');
        }
        return $authManager;
    }

    public function up() {

        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;
        $this->createIndex('auth_assigment_user_id_idx', $authManager->assignmentTable, 'user_id');
    }

    public function down() {
        echo "m170810_102430_add_key_user_id cannot be reverted.\n";

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
