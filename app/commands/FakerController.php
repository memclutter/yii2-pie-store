<?php

namespace app\commands;

use app\models\Product;
use Faker\Factory;
use yii\console\Controller;
use yii\console\Exception;
use yii\db\Query;
use yii\helpers\ArrayHelper;

/**
 * Data generator.
 *
 * @package app\commands
 */
class FakerController extends Controller
{
    /**
     * Generate products.
     *
     * @param int $count count of products to generate
     * @throws Exception
     */
    public function actionProducts($count = 100)
    {
        $faker = Factory::create();
        $db = \Yii::$app->db;

        $sizes    = ArrayHelper::map($db->createCommand('SELECT * FROM sizes')->queryAll(), 'id', 'size');
        $stuffing = ArrayHelper::map($db->createCommand('SELECT * FROM stuffing')->queryAll(), 'id', 'stuffing');
        $targets  = ArrayHelper::map($db->createCommand('SELECT * FROM targets')->queryAll(), 'id', 'target');
        $pastes   = ArrayHelper::map($db->createCommand('SELECT * FROM pastes')->queryAll(), 'id', 'paste');
        $ovens    = ArrayHelper::map($db->createCommand('SELECT * FROM ovens')->queryAll(), 'id', 'oven');

        for ($i = 0; $i < $count; $i++) {
            $product = new Product();

            $product->title           = $faker->words(2, true);
            $product->description     = $faker->text(200);
            $product->price           = $faker->randomFloat(2, 0.10, 1000);
            $product->available_count = $faker->randomDigit;

            $product->size_id     = $faker->randomKey($sizes);
            $product->stuffing_id = $faker->randomKey($stuffing);
            $product->target_id   = $faker->randomKey($targets);
            $product->paste_id    = $faker->randomKey($pastes);
            $product->oven_id     = $faker->randomKey($ovens);

            if (!$product->save()) {
                throw new Exception("Failed to save Product\n\n" .
                    print_r($product->getErrors(), true));
            }

            $this->stdout("'{$product->title}' saved ...\n");
        }
    }
}