<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%users_words}}`.
 */
class m190716_083914_add_status_column_to_users_words_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%users_words}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%users_words}}', 'status');
    }
}
