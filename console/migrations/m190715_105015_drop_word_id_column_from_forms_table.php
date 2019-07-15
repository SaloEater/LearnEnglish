<?php

use yii\db\Migration;

/**
 * Handles dropping word_id from table `{{%form}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%word}}`
 */
class m190715_105015_drop_word_id_column_from_forms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // drops foreign key for table `{{%word}}`
        $this->dropForeignKey(
            '{{%fk-forms-word_id}}',
            '{{%form}}'
        );

        // drops index for column `word_id`
        $this->dropIndex(
            '{{%idx-forms-word_id}}',
            '{{%form}}'
        );

        $this->dropColumn('{{%form}}', 'word_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('{{%form}}', 'word_id', $this->integer());

        // creates index for column `word_id`
        $this->createIndex(
            '{{%idx-forms-word_id}}',
            '{{%form}}',
            'word_id'
        );

        // add foreign key for table `{{%word}}`
        $this->addForeignKey(
            '{{%fk-forms-word_id}}',
            '{{%form}}',
            'word_id',
            '{{%word}}',
            'id',
            'CASCADE'
        );
    }
}
