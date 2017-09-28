<?php

use yii\db\Migration;

class m160530_051142_tbl_user_details extends Migration {

    public function up() {
        $this->createTable("tbl_user_details", [
            'id' => 'int(11) NOT NULL AUTO_INCREMENT',
            'user_id' => 'int(11) NOT NULL UNIQUE',
            'first_name' => 'varchar(256) NOT NULL',
            'middle_name' => 'varchar(256) DEFAULT NULL',
            'last_name' => 'varchar(256) NOT NULL',
            'address' => 'varchar(30) DEFAULT NULL',
            'city' => 'varchar(256) DEFAULT NULL',
            'state' => 'varchar(256) DEFAULT NULL',
            'zip' => 'varchar(12) DEFAULT NULL',
            'phone' => 'varchar(20) DEFAULT NULL',
            'mobile' => 'varchar(12) DEFAULT NULL',
            'designation' => 'varchar(256) DEFAULT NULL',
            'created_at' => 'datetime NOT NULL',
            'modified_at' => 'datetime DEFAULT NULL',
            'PRIMARY KEY (`id`)',
                ], 'ENGINE = InnoDB DEFAULT CHARSET = latin1 AUTO_INCREMENT = 1'
        );
    }

    public function down() {
        echo "m160530_051142_tbl_user_details cannot be reverted.\n";

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
