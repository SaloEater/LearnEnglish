<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%forms}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%word}}`
 */
class m190712_123932_create_forms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%forms}}', [
            'id' => $this->primaryKey(),
            'content' => $this->string(64),
            'word_id' => $this->integer(),
        ]);

        // creates index for column `word_id`
        $this->createIndex(
            '{{%idx-forms-word_id}}',
            '{{%forms}}',
            'word_id'
        );

        // add foreign key for table `{{%word}}`
        $this->addForeignKey(
            '{{%fk-forms-word_id}}',
            '{{%forms}}',
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
        // drops foreign key for table `{{%word}}`
        $this->dropForeignKey(
            '{{%fk-forms-word_id}}',
            '{{%forms}}'
        );

        // drops index for column `word_id`
        $this->dropIndex(
            '{{%idx-forms-word_id}}',
            '{{%forms}}'
        );

        $this->dropTable('{{%forms}}');
    }
}
