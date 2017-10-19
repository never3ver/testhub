<?php

use yii\db\Migration;

/**
 * Handles the creation of table `question`.
 * Has foreign keys to the tables:
 *
 * - `test`
 */
class m170419_075354_create_question_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('question', [
            'id' => $this->primaryKey(),
            'qdescription' => $this->string(),
            'test_id' => $this->integer(),
        ]);

        // creates index for column `id_test`
        $this->createIndex(
            'idx-question-test_id',
            'question',
            'test_id'
        );

        // add foreign key for table `test`
        $this->addForeignKey(
            'fk-question-test_id',
            'question',
            'test_id',
            'test',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `test`
        $this->dropForeignKey(
            'fk-question-test_id',
            'question'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-question-test_id',
            'question'
        );

        $this->dropTable('question');
    }
}
