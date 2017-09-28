<?php

use yii\db\Schema;
use yii\db\Migration;

class m160730_105342_device_credentials_global_column extends Migration {

    public function up() {
        $this->addColumn('tbl_device_credentials', 'is_global', 'INT(1) DEFAULT 0 AFTER `privacy_type` ');
    }

    public function down() {
        echo "m160730_105342_device_credentials_global_column cannot be reverted.\n";

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
