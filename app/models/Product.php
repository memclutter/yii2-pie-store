<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $available_count
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'price'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['available_count'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'available_count' => Yii::t('app', 'Available Count'),
        ];
    }
}
