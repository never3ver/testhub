<?php

use yii\db\Migration;

/**
 * Handles the creation of table `anonuser`.
 */
class m170407_071819_create_anonuser_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('anonuser', [
            'id' => $this->primaryKey(),
            'cookie' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('anonuser');
    }
}
