<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forms_words}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%form}}`
 * - `{{%word}}`
 */
class m190715_103820_create_junction_table_for_form_and_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forms_words}}', [
            'form_id' => $this->integer(),
            'word_id' => $this->integer(),
            'PRIMARY KEY(form_id, word_id)',
        ]);

        // creates index for column `form_id`
        $this->createIndex(
            '{{%idx-form_word-form_id}}',
            '{{%forms_words}}',
            'form_id'
        );

        // add foreign key for table `{{%form}}`
        $this->addForeignKey(
            '{{%fk-form_word-form_id}}',
            '{{%forms_words}}',
            'form_id',
            '{{%form}}',
            'id',
            'CASCADE'
        );

        // creates index for column `word_id`
        $this->createIndex(
            '{{%idx-form_word-word_id}}',
            '{{%forms_words}}',
            'word_id'
        );

        // add foreign key for table `{{%word}}`
        $this->addForeignKey(
            '{{%fk-form_word-word_id}}',
            '{{%forms_words}}',
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
        // drops foreign key for table `{{%form}}`
        $this->dropForeignKey(
            '{{%fk-form_word-form_id}}',
            '{{%forms_words}}'
        );

        // drops index for column `form_id`
        $this->dropIndex(
            '{{%idx-form_word-form_id}}',
            '{{%forms_words}}'
        );

        // drops foreign key for table `{{%word}}`
        $this->dropForeignKey(
            '{{%fk-form_word-word_id}}',
            '{{%forms_words}}'
        );

        // drops index for column `word_id`
        $this->dropIndex(
            '{{%idx-form_word-word_id}}',
            '{{%forms_words}}'
        );

        $this->dropTable('{{%forms_words}}');
    }
}
