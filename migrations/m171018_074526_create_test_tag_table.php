<?php

use yii\db\Migration;

/**
 * Handles the creation of table `test_tag`.
 * Has foreign keys to the tables:
 *
 * - `tag`
 * - `test`
 */
class m171018_074526_create_test_tag_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('test_tag', [
            'id' => $this->primaryKey(),
            'tag_id' => $this->integer(),
            'test_id' => $this->integer(),
        ]);

        // creates index for column `tag_id`
        $this->createIndex(
            'idx-test_tag-tag_id',
            'test_tag',
            'tag_id'
        );

        // add foreign key for table `tag`
        $this->addForeignKey(
            'fk-test_tag-tag_id',
            'test_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );

        // creates index for column `test_id`
        $this->createIndex(
            'idx-test_tag-test_id',
            'test_tag',
            'test_id'
        );

        // add foreign key for table `test`
        $this->addForeignKey(
            'fk-test_tag-test_id',
            'test_tag',
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
        // drops foreign key for table `tag`
        $this->dropForeignKey(
            'fk-test_tag-tag_id',
            'test_tag'
        );

        // drops index for column `tag_id`
        $this->dropIndex(
            'idx-test_tag-tag_id',
            'test_tag'
        );

        // drops foreign key for table `test`
        $this->dropForeignKey(
            'fk-test_tag-test_id',
            'test_tag'
        );

        // drops index for column `test_id`
        $this->dropIndex(
            'idx-test_tag-test_id',
            'test_tag'
        );

        $this->dropTable('test_tag');
    }
}
