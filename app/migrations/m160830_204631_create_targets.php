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

        $this->createTable('{{%attr_target}}', [
            'id' => $this->string(128)->unique()->notNull(),
            'value' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'target_id', $this->string(128)->defaultValue(null));
        $this->addForeignKey('fk-products-attr_target', '{{%products}}', 'target_id', '{{%attr_target}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-attr_target', '{{%products}}');
        $this->dropColumn('{{%products}}', 'target_id');
        $this->dropTable('{{%attr_target}}');
    }
}
