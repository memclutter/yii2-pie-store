<?php

use yii\db\Migration;

class m160830_210943_init_data extends Migration
{
    public $sizes = [
        'XXL',
        'Огромные',
        'Большие',
        'Средние',
        'Маленькие',
        'Мини-пирожки',
    ];

    public $stuffing = [
        'Картошка',
        'Капуста',
        'Курица',
        'Свинина',
        'Сосика',
        'Яйца с луком',
        'Яблоки',
        'Вишня',
        'Клубника',
        'Баранина',
        'Сыр',
        'Творог',
    ];

    public $targets = [
        'Сытный',
        'Легкий',
        'Подарочный',
        'В дорогу',
        'Обеденный',
        'Домашний',
    ];

    public $pastes = [
        'Бисквитное',
        'Блинное',
        'Дрожевое',
        'Бездрожевое',
        'Заварное',
        'Песочное',
        'Пресное',
        'Сдобное',
        'Слоенное',
        'Воздушное',
        'Ржаное',
    ];

    public $ovens = [
        'В духовке',
        'На дровах',
        'Жаренные',
        'На пару',
    ];

    public function safeUp()
    {
        $this->batchInsert('{{%sizes}}', ['size'], array_map(
            function($value) {
                return [$value];
            },
            $this->sizes
        ));
        $this->batchInsert('{{%stuffing}}', ['stuffing'], array_map(
            function($value) {
                return [$value];
            },
            $this->stuffing
        ));
        $this->batchInsert('{{%targets}}', ['target'], array_map(
            function($value) {
                return [$value];
            },
            $this->targets
        ));
        $this->batchInsert('{{%pastes}}', ['paste'], array_map(
            function($value) {
                return [$value];
            },
            $this->pastes
        ));
        $this->batchInsert('{{%ovens}}', ['oven'], array_map(
            function($value) {
                return [$value];
            },
            $this->ovens
        ));
    }

    public function safeDown()
    {
        $this->delete('{{%ovens}}');
        $this->delete('{{%pastes}}');
        $this->delete('{{%targets}}');
        $this->delete('{{%stuffing}}');
        $this->delete('{{%sizes}}');
    }
}
