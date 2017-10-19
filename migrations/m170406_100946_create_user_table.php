<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170406_100946_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'email'=> $this->string()->defaultValue(NULL),
            'password'=> $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
