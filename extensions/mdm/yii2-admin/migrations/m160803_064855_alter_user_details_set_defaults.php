<?php

use yii\db\Migration;

class m160803_064855_alter_user_details_set_defaults extends Migration {

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp() {
        $this->alterColumn('tbl_user_details', 'first_name', $this->string(256));
        $this->alterColumn('tbl_user_details', 'last_name', $this->string(256));
    }

    public function safeDown() {
        echo "\nMigration m160803_064855_alter_user_details_set_defaults can not be reverted";
        return false;
    }

}
