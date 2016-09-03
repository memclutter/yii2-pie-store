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

        $this->createTable('{{%attr_size}}', [
            'id' => $this->string(128)->unique()->notNull(),
            'value' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'size_id', $this->string(128)->defaultValue(null));
        $this->addForeignKey('fk-products-sizes', '{{%products}}', 'size_id', '{{%attr_size}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-sizes', '{{%products}}');
        $this->dropColumn('{{%products}}', 'size_id');
        $this->dropTable('{{%attr_size}}');
    }
}
