<?php

use yii\db\Migration;

class m160830_195706_create_products extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(128)->notNull(),
            'description' => $this->text(),
            'price' => $this->decimal(10, 2)->notNull(),
            'available_count' => $this->integer()->defaultValue(null),
        ], $tableOptions);

        $this->createIndex('idx-product-price', '{{%products}}', 'price');
        $this->createIndex('idx-product-title', '{{%products}}', 'title');
    }

    public function safeDown()
    {
        $this->dropIndex('idx-product-title', '{{%products}}');
        $this->dropIndex('idx-product-price', '{{%products}}');
        $this->dropTable('{{%products}}');
    }
}
