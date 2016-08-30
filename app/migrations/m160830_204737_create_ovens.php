<?php

use yii\db\Migration;

class m160830_204737_create_ovens extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%ovens}}', [
            'id' => $this->primaryKey(),
            'oven' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'oven_id', $this->integer()->defaultValue(null));
        $this->addForeignKey('fk-products-ovens', '{{%products}}', 'oven_id', '{{%ovens}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-ovens', '{{%products}}');
        $this->dropColumn('{{%products}}', 'oven_id');
        $this->dropTable('{{%ovens}}');
    }
}
