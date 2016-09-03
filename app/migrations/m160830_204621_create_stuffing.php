<?php

use yii\db\Migration;

class m160830_204621_create_stuffing extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attr_stuffing}}', [
            'id' => $this->string(128)->unique()->notNull(),
            'value' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'stuffing_id', $this->string(128)->defaultValue(null));
        $this->addForeignKey('fk-products-stuffing', '{{%products}}', 'stuffing_id', '{{%attr_stuffing}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-stuffing', '{{%products}}');
        $this->dropColumn('{{%products}}', 'stuffing_id');
        $this->dropTable('{{%attr_stuffing}}');
    }
}
