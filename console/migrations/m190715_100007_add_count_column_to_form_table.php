<?php

use yii\db\Migration;

/**
 * Handles adding count to table `{{%form}}`.
 */
class m190715_100007_add_count_column_to_form_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%form}}', 'count', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%form}}', 'count');
    }
}
