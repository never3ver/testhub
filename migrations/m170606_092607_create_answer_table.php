<?php

use yii\db\Migration;

/**
 * Handles the creation of table `answer`.
 * Has foreign keys to the tables:
 *
 * - `question`
 */
class m170606_092607_create_answer_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('answer', [
            'id' => $this->primaryKey(),
            'question_id' => $this->integer(),
            'is_correct' => $this->boolean(),
            'body' => $this->text(),
        ]);

        // creates index for column `question_id`
        $this->createIndex(
            'idx-answer-question_id',
            'answer',
            'question_id'
        );

        // add foreign key for table `question`
        $this->addForeignKey(
            'fk-answer-question_id',
            'answer',
            'question_id',
            'question',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `question`
        $this->dropForeignKey(
            'fk-answer-question_id',
            'answer'
        );

        // drops index for column `question_id`
        $this->dropIndex(
            'idx-answer-question_id',
            'answer'
        );

        $this->dropTable('answer');
    }
}
