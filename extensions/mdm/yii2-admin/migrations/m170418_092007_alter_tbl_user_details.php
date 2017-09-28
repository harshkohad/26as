<?php

use yii\db\Migration;

class m170418_092007_alter_tbl_user_details extends Migration {

    public function up() {
        $this->addColumn("tbl_user_details", "acronym", $this->string(3)->after('last_name'));
        $this->addColumn("tbl_user_details", "department", $this->integer(11)->after('designation'));
    }

    public function down() {
        echo "m170418_092007_alter_tbl_user_details cannot be reverted.\n";

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
