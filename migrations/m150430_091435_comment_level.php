<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150430_091435_comment_level
 */
class m150430_091435_comment_level extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'level', Schema::TYPE_INTEGER . ' DEFAULT 1');

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropColumn('comment', 'level');

        echo "m150430_091435_comment_level reverted.\n";

        return true;
    }
}