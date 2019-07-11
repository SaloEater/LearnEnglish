<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%word}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%sentence}}`
 */
class m190711_124606_create_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%word}}', [
            'id' => $this->primaryKey(),
            'value' => $this->string(64)->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'count' => $this->integer(),
            'sentence_id' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        // creates index for column `sentence_id`
        $this->createIndex(
            '{{%idx-word-sentence_id}}',
            '{{%word}}',
            'sentence_id'
        );

        // add foreign key for table `{{%sentence}}`
        $this->addForeignKey(
            '{{%fk-word-sentence_id}}',
            '{{%word}}',
            'sentence_id',
            '{{%sentence}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%sentence}}`
        $this->dropForeignKey(
            '{{%fk-word-sentence_id}}',
            '{{%word}}'
        );

        // drops index for column `sentence_id`
        $this->dropIndex(
            '{{%idx-word-sentence_id}}',
            '{{%word}}'
        );

        $this->dropTable('{{%word}}');
    }
}