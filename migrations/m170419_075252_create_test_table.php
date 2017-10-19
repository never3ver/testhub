<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test`.
 */
class m170419_075252_create_test_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->string(),
            'user_id' => $this->integer(),
            'date' => $this->timestamp('NOT NULL DEFAULT CURRENT_TIMESTAMP'),
            'tried' => $this->integer(),
            'passed' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('test');
    }

}
