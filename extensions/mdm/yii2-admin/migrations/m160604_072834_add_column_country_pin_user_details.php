<?php

use yii\db\Migration;

class m160604_072834_add_column_country_pin_user_details extends Migration {

    public function up() {
        $this->addColumn("tbl_user_details", "country", "varchar(50) NULL AFTER `state`");
        $this->addColumn("tbl_user_details", "pin", "int(6) NULL AFTER `country`");
    }

    public function down() {
        echo "m160604_072834_add_column_country_pin_user_details cannot be reverted.\n";

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
