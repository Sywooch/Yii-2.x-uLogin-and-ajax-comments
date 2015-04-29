<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_093235_post
 */
class m150429_093235_post extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => 'pk',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'content' => Schema::TYPE_TEXT . ' NOT NULL',
            'authorID' => Schema::TYPE_INTEGER . ' NOT NULL'
        ]);

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropTable('post');

        echo "m150429_093235_post reverted.\n";

        return true;
    }
}