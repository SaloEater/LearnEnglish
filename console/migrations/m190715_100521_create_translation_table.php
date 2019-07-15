<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%translation}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%word}}`
 */
class m190715_100521_create_translation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%translation}}', [
            'id' => $this->primaryKey(),
            'content' => $this->string(64)->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'type' => $this->string(64)->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'sort' => $this->integer(),
            'word_id' => $this->integer(),
        ]);

        // creates index for column `word_id`
        $this->createIndex(
            '{{%idx-translation-word_id}}',
            '{{%translation}}',
            'word_id'
        );

        // add foreign key for table `{{%word}}`
        $this->addForeignKey(
            '{{%fk-translation-word_id}}',
            '{{%translation}}',
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
            '{{%fk-translation-word_id}}',
            '{{%translation}}'
        );

        // drops index for column `word_id`
        $this->dropIndex(
            '{{%idx-translation-word_id}}',
            '{{%translation}}'
        );

        $this->dropTable('{{%translation}}');
    }
}
