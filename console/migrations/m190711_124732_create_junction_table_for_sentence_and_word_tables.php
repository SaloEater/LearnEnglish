<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sentence_word}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%sentence}}`
 * - `{{%word}}`
 */
class m190711_124732_create_junction_table_for_sentence_and_word_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sentence_word}}', [
            'sentence_id' => $this->integer(),
            'word_id' => $this->integer(),
            'PRIMARY KEY(sentence_id, word_id)',
        ]);

        // creates index for column `sentence_id`
        $this->createIndex(
            '{{%idx-sentence_word-sentence_id}}',
            '{{%sentence_word}}',
            'sentence_id'
        );

        // add foreign key for table `{{%sentence}}`
        $this->addForeignKey(
            '{{%fk-sentence_word-sentence_id}}',
            '{{%sentence_word}}',
            'sentence_id',
            '{{%sentence}}',
            'id',
            'CASCADE'
        );

        // creates index for column `word_id`
        $this->createIndex(
            '{{%idx-sentence_word-word_id}}',
            '{{%sentence_word}}',
            'word_id'
        );

        // add foreign key for table `{{%word}}`
        $this->addForeignKey(
            '{{%fk-sentence_word-word_id}}',
            '{{%sentence_word}}',
            'word_id',
            '{{%word}}',
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
            '{{%fk-sentence_word-sentence_id}}',
            '{{%sentence_word}}'
        );

        // drops index for column `sentence_id`
        $this->dropIndex(
            '{{%idx-sentence_word-sentence_id}}',
            '{{%sentence_word}}'
        );

        // drops foreign key for table `{{%word}}`
        $this->dropForeignKey(
            '{{%fk-sentence_word-word_id}}',
            '{{%sentence_word}}'
        );

        // drops index for column `word_id`
        $this->dropIndex(
            '{{%idx-sentence_word-word_id}}',
            '{{%sentence_word}}'
        );

        $this->dropTable('{{%sentence_word}}');
    }
}
