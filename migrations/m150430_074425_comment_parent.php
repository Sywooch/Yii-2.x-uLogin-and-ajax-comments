<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150430_074425_comment_parent
 */
class m150430_074425_comment_parent extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->addColumn('comment', 'parentID', Schema::TYPE_INTEGER . ' NULL');

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropColumn('comment', 'parentID');
        echo "m150430_074425_comment_parent reverted.\n";

        return true;
    }
}