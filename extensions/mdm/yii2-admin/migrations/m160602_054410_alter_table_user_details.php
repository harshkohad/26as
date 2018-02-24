<?php

use yii\db\Migration;

class m160602_054410_alter_table_user_details extends Migration {

    public function up() {
        $this->addColumn("tbl_user_details", "current_login_time", "datetime NULL");
        $this->addColumn("tbl_user_details", "last_login_time", "datetime NULL");
        $this->addColumn("tbl_user_details", "current_login_ip", "varchar(20) NULL");
        $this->addColumn("tbl_user_details", "last_login_ip", "varchar(20) NULL");
        $this->alterColumn("tbl_user_details", "address", "TEXT NULL");
    }

    public function down() {
        echo "m160602_054410_alter_table_user_details cannot be reverted.\n";

        return false;
    }

}
