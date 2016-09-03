<?php

namespace app\models;

use Yii;
use yii\base\Object;
use yii\db\Query;

class ProductAttribute extends Object
{
    const TYPE_SIZE = 'size';
    const TYPE_STUFFING = 'stuffing';
    const TYPE_TARGET = 'target';
    const TYPE_PASTE = 'paste';
    const TYPE_OVEN = 'oven';

    const ALL_TYPES = [
        self::TYPE_SIZE,
        self::TYPE_STUFFING,
        self::TYPE_TARGET,
        self::TYPE_PASTE,
        self::TYPE_OVEN,
    ];

    private static $hashMapCaches = [];

    public static function getAttributeType($value)
    {
        foreach (static::ALL_TYPES as $type) {
            if (array_key_exists($value, static::getHashMap($type))) {
                return $type;
            }
        }

        return false;
    }

    public static function getHashMap($type, $idAttribute = 'id', $valueAttribute = 'value')
    {
        if (!isset(static::$hashMapCaches[$type])) {
            static::$hashMapCaches[$type] = Yii::$app->db->cache(function($db) use ($type, $idAttribute, $valueAttribute) {
                return (new Query())
                    ->from('{{%attr_' . $type . '}}')
                    ->select([$valueAttribute, $idAttribute])
                    ->indexBy($idAttribute)
                    ->column();
            });
        }

        return static::$hashMapCaches[$type];
    }
}