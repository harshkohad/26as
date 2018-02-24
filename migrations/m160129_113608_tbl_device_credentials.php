<?php

use yii\db\Schema;
use yii\db\Migration;

class m160129_113608_tbl_device_credentials extends Migration
{
    public function up()
    {
        $this->createTable('tbl_device_credentials', [
            'id' => $this->primaryKey(),
            'label' => $this->string(256)->notNull(),
            'username' => $this->string(256),
            'password' => $this->string(50),
            'enable_password' => $this->string(50),
            'protocol' => $this->string(15),
            'snmp_version' => 'ENUM ("v1", "v2c", "v3")',
            'snmp_community' => $this->string(256),
            'auth_type' => 'ENUM ("MD5", "SHA1", "N/A")',
            'privacy_type' => 'ENUM ("DES", "AES128", "N/A")',
            'include_devices' => 'LONGTEXT',
            'exclude_devices' => 'LONGTEXT',
            'sort_order' => $this->integer()->notNull(),
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'modified_at' => Schema::TYPE_TIMESTAMP . ' NOT NULL',
            'created_by' => $this->integer()->notNull(),
            'modified_by' => $this->integer()->notNull(),
        ]);
    }

    public function down()
    {
        return $this->dropTable('tbl_device_credentials');
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
