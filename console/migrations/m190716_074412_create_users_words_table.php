<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_words}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%word}}`
 */
class m190716_074412_create_users_words_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_words}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'word_id' => $this->integer(),
            'count' => $this->integer(),
            'order' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-users_words-user_id}}',
            '{{%users_words}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-users_words-user_id}}',
            '{{%users_words}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `word_id`
        $this->createIndex(
            '{{%idx-users_words-word_id}}',
            '{{%users_words}}',
            'word_id'
        );

        // add foreign key for table `{{%word}}`
        $this->addForeignKey(
            '{{%fk-users_words-word_id}}',
            '{{%users_words}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-users_words-user_id}}',
            '{{%users_words}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-users_words-user_id}}',
            '{{%users_words}}'
        );

        // drops foreign key for table `{{%word}}`
        $this->dropForeignKey(
            '{{%fk-users_words-word_id}}',
            '{{%users_words}}'
        );

        // drops index for column `word_id`
        $this->dropIndex(
            '{{%idx-users_words-word_id}}',
            '{{%users_words}}'
        );

        $this->dropTable('{{%users_words}}');
    }
}
