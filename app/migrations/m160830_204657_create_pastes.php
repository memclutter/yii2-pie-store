<?php

use yii\db\Migration;

class m160830_204657_create_pastes extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%attr_paste}}', [
            'id' => $this->string(128)->unique()->notNull(),
            'value' => $this->string(128)->notNull(),
        ], $tableOptions);

        $this->addColumn('{{%products}}', 'paste_id', $this->string(128)->defaultValue(null));
        $this->addForeignKey('fk-products-attr_paste', '{{%products}}', 'paste_id', '{{%attr_paste}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-products-attr_paste', '{{%products}}');
        $this->dropColumn('{{%products}}', 'paste_id');
        $this->dropTable('{{%attr_paste}}');
    }
}
