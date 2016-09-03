<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $price
 * @property integer $available_count
 * @property integer $size_id
 * @property integer $stuffing_id
 * @property integer $target_id
 * @property integer $paste_id
 * @property integer $oven_id
 * @property string $size
 * @property string $stuffing
 * @property string $target
 * @property string $paste
 * @property string $oven
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

    public function attributes()
    {
        return ArrayHelper::merge(parent::attributes(), [
            'size',
            'stuffing',
            'target',
            'paste',
            'oven',
        ]);
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
            [['size_id', 'stuffing_id', 'target_id', 'paste_id', 'oven_id'], 'string'],
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

    public static function find()
    {
        return parent::find()
            ->select([
                'products.*',
                'size' => 'attr_size.value',
                'stuffing' => 'attr_stuffing.value',
                'target' => 'attr_target.value',
                'paste' => 'attr_paste.value',
                'oven' => 'attr_oven.value',
            ])
            ->leftJoin('attr_size', 'attr_size.id = products.size_id')
            ->leftJoin('attr_stuffing', 'attr_stuffing.id = products.stuffing_id')
            ->leftJoin('attr_target', 'attr_target.id = products.target_id')
            ->leftJoin('attr_paste', 'attr_paste.id = products.paste_id')
            ->leftJoin('attr_oven', 'attr_oven.id = products.oven_id');
    }
}
