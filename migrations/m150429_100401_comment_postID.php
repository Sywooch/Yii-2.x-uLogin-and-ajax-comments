<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_100401_comment_postID
 */
class m150429_100401_comment_postID extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'postID', Schema::TYPE_INTEGER . ' NOT NULL');

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropColumn('comment', 'postID');

        echo "m150429_100401_comment_postID reverted.\n";

        return true;
    }
}