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
            [['size_id', 'stuffing_id', 'target_id', 'paste_id', 'oven_id'], 'integer'],
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
                'size',
                'stuffing',
                'target',
                'paste',
                'oven',
            ])
            ->leftJoin('sizes', 'sizes.id = products.size_id')
            ->leftJoin('stuffing', 'stuffing.id = products.stuffing_id')
            ->leftJoin('targets', 'targets.id = products.target_id')
            ->leftJoin('pastes', 'pastes.id = products.paste_id')
            ->leftJoin('ovens', 'ovens.id = products.oven_id');
    }
}
