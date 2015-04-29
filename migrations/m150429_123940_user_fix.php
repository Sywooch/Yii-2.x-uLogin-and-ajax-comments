<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_123940_user_fix
 */
class m150429_123940_user_fix extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        // first name
        $this->renameColumn('user', 'username', 'fname');
        // second name
        $this->addColumn('user', 'sname', Schema::TYPE_STRING . ' NULL');
        $this->dropColumn('user', 'password');

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        echo "m150429_123940_user_fix cannot be reverted.\n";

        return false;
    }
}
