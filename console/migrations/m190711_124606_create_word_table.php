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
            'content' => $this->string(64)->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'count' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%word}}');
    }
}
