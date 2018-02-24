<?php

use yii\db\Migration;

class m160506_074835_create_tbl_session extends Migration {

    public function up() {
        $this->createTable('tbl_session', [
            'id' => "CHAR(40) NOT NULL PRIMARY KEY",
            'expire' => $this->integer(),
            'data' => $this->binary()
        ]);
    }

    public function down() {
        $this->dropTable('tbl_session');
    }

}
