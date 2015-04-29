<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_133744_user_authKey
 */
class m150429_133744_user_authKey extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->addColumn('user', 'authKey', Schema::TYPE_STRING . ' NULL');

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'authKey');

        echo "m150429_133744_user_authKey reverted.\n";

        return true;
    }
}