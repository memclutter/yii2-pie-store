<?php

use yii\db\Migration;

class m160830_204554_create_sizes extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%sizes}}', [
            'id' => $this->primaryKey(),
            'size' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'size_id', $this->integer()->defaultValue(null));
        $this->addForeignKey('fk-products-sizes', '{{%products}}', 'size_id', '{{%sizes}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-sizes', '{{%products}}');
        $this->dropColumn('{{%products}}', 'size_id');
        $this->dropTable('{{%sizes}}');
    }
}
