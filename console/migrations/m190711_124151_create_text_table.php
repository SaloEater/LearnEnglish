<?php

include "traits/TextTypesTrait.php";

use yii\db\Migration;

/**
 * Handles the creation of table `{{%text}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m190711_124151_create_text_table extends Migration
{
    use TextTypesTrait;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%text}}', [
            'id' => $this->primaryKey(),
            'content' => $this->mediumText()->append('CHARACTER SET utf8 COLLATE utf8_general_ci'),
            'md5' => $this->char(32),
            'created_at' => $this->integer(11),
            'updated_at' => $this->integer(11),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB');

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-text-created_by}}',
            '{{%text}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-text-created_by}}',
            '{{%text}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-text-updated_by}}',
            '{{%text}}',
            'updated_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-text-updated_by}}',
            '{{%text}}',
            'updated_by',
            '{{%user}}',
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
            '{{%fk-text-created_by}}',
            '{{%text}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-text-created_by}}',
            '{{%text}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-text-updated_by}}',
            '{{%text}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-text-updated_by}}',
            '{{%text}}'
        );

        $this->dropTable('{{%text}}');
    }
}
