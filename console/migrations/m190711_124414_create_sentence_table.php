<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sentence}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%text}}`
 */
class m190711_124414_create_sentence_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sentence}}', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'text_id' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        // creates index for column `text_id`
        $this->createIndex(
            '{{%idx-sentence-text_id}}',
            '{{%sentence}}',
            'text_id'
        );

        // add foreign key for table `{{%text}}`
        $this->addForeignKey(
            '{{%fk-sentence-text_id}}',
            '{{%sentence}}',
            'text_id',
            '{{%text}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%text}}`
        $this->dropForeignKey(
            '{{%fk-sentence-text_id}}',
            '{{%sentence}}'
        );

        // drops index for column `text_id`
        $this->dropIndex(
            '{{%idx-sentence-text_id}}',
            '{{%sentence}}'
        );

        $this->dropTable('{{%sentence}}');
    }
}
