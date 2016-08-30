<?php

use yii\db\Migration;

class m160830_204631_create_targets extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%targets}}', [
            'id' => $this->primaryKey(),
            'target' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'target_id', $this->integer()->defaultValue(null));
        $this->addForeignKey('fk-products-targets', '{{%products}}', 'target_id', '{{%targets}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-targets', '{{%products}}');
        $this->dropColumn('{{%products}}', 'target_id');
        $this->dropTable('{{%targets}}');
    }
}
