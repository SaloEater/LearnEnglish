<?php

use yii\db\Migration;

/**
 * Class m190716_073135_update_md5_column
 */
class m190716_073135_update_md5_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('text', 'md5', $this->char(32)->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('text', 'md5', $this->char(32));
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190716_073135_update_md5_column cannot be reverted.\n";

        return false;
    }
    */
}
