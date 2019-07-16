<?php

use yii\db\Migration;

/**
 * Handles adding order to table `{{%word}}`.
 */
class m190716_074135_add_order_column_to_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%word}}', 'order', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%word}}', 'order');
    }
}
