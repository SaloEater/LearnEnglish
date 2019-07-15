<?php

use yii\db\Migration;

/**
 * Class m190715_075456_rename_forms_table
 */
class m190715_075456_rename_forms_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameTable('forms', 'form');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameTable('form', 'forms');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190715_075456_rename_forms_table cannot be reverted.\n";

        return false;
    }
    */
}
