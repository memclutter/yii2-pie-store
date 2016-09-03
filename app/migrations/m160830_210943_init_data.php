<?php

use yii\db\Migration;

class m160830_210943_init_data extends Migration
{
    public $fixtures = [
        'attr_size' => [
            'xxl' => 'XXL',
            'large' => 'Огромные',
            'big' => 'Большие',
            'medium' => 'Средние',
            'small' => 'Маленькие',
            'extra-small' => 'Мини-пирожки',
        ],
        'attr_stuffing' => [
            'potato' => 'Картошка',
            'cabbage' => 'Капуста',
            'chicken' => 'Курица',
            'pork' => 'Свинина',
            'sausage' => 'Сосика',
            'eggs-with-onion' => 'Яйца с луком',
            'apples' => 'Яблоки',
            'cherry' => 'Вишня',
            'strawberry' => 'Клубника',
            'mutton' => 'Баранина',
            'cheese' => 'Сыр',
            'curd' => 'Творог',
        ],
        'attr_target' => [
            'satisfying' => 'Сытный',
            'light' => 'Легкий',
            'courtesy' => 'Подарочный',
            'on-the-road' => 'В дорогу',
            'dining' => 'Обеденный',
            'home' => 'Домашний',
        ],
        'attr_paste' => [
            'biscuit' => 'Бисквитное',
            'pancake' => 'Блинное',
            'yeast' => 'Дрожевое',
            'without-yeast' => 'Бездрожевое',
            'brewing' => 'Заварное',
            'shortbread' => 'Песочное',
            'unleavened' => 'Пресное',
            'butter' => 'Сдобное',
            'puff' => 'Слоенное',
            'air' => 'Воздушное',
            'rye' => 'Ржаное',
        ],
        'attr_oven' => [
            'in-the-oven' => 'В духовке',
            'on-the-wood' => 'На дровах',
            'fired' => 'Жаренные',
            'steamed' => 'На пару',
        ],
    ];

    public function safeUp()
    {
        foreach ($this->fixtures as $table => $data) {
            $this->batchInsert('{{%' . $table . '}}', ['id', 'value'], array_map(
                function($id, $value) {
                    return [$id, $value];
                },
                array_keys($data), $data
            ));
        }
    }

    public function safeDown()
    {
        foreach (array_keys($this->fixtures) as $table) {
            $this->delete('{{%' . $table . '}}');
        }
    }
}
