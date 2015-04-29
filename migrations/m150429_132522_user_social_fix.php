<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150429_132522_user_social_fix
 */
class m150429_132522_user_social_fix extends Migration
{
    /**
     * @return bool
     */
    public function safeUp()
    {
        $this->dropColumn('user', 'email');
        $this->addColumn('user_social', 'email', Schema::TYPE_STRING . ' NULL');

        return true;
    }

    /**
     * @return bool
     */
    public function safeDown()
    {
        $this->addColumn('user', 'email', Schema::TYPE_STRING . ' NULL');
        $this->dropColumn('user_social', 'email');
        
        echo "m150429_132522_user_social_fix reverted.\n";

        return true;
    }
}