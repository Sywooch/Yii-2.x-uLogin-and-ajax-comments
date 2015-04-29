<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_123403_user_social
 */
class m150429_123403_user_social extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->createTable('user_social', [
            'id' => 'pk',
            'userID' => Schema::TYPE_INTEGER . ' NOT NULL',
            'first_name' => Schema::TYPE_STRING . ' NULL',
            'last_name' => Schema::TYPE_STRING . ' NULL',
            'network' => Schema::TYPE_STRING . ' NULL',
            'profile' => Schema::TYPE_STRING . ' NULL',
            'uid' => Schema::TYPE_BIGINT . ' NULL',
            'identity' => Schema::TYPE_STRING . ' NULL',
            'manual' => Schema::TYPE_STRING . ' NULL',
            'verified_email' => Schema::TYPE_INTEGER . ' NULL'
        ]);

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropTable('user_social');

        echo "m150429_123403_user_social reverted.\n";

        return true;
    }
}
