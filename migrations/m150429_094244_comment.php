<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_094244_comment
 */
class m150429_094244_comment extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('comment', [
            'id' => 'pk',
            'authorID' => Schema::TYPE_INTEGER,
            'content' => Schema::TYPE_STRING,
            'timeCreate' => Schema::TYPE_BIGINT,

        ]);
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropTable('comment');

        echo "m150429_094244_comment reverted.\n";

        return true;
    }
}