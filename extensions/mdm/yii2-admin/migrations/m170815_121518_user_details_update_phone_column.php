<?php

use yii\db\Migration;

class m170815_121518_user_details_update_phone_column extends Migration {

    public function up() {
        $this->alterColumn('tbl_user_details', 'mobile', $this->string(20)->defaultValue(''));
    }

    public function down() {
        echo "m170815_121518_user_details_update_phone_column cannot be reverted.\n";

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
