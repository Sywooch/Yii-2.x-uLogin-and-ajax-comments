<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_093523_user
 */
class m150429_093523_user extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => 'pk',
            'username' => Schema::TYPE_STRING . ' NULL',
            'password' => Schema::TYPE_STRING . ' NOT NULL',
            'email' => Schema::TYPE_STRING . ' NOT NULL'
        ]);

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropTable('user');

        echo "m150429_093523_user reverted.\n";

        return true;
    }
}