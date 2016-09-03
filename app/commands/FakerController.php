<?php

namespace app\commands;

use app\models\Product;
use app\models\ProductAttribute;
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

        Product::deleteAll();

        $sizes    = ProductAttribute::getHashMap('size');
        $stuffing = ProductAttribute::getHashMap('stuffing');
        $targets  = ProductAttribute::getHashMap('target');
        $pastes   = ProductAttribute::getHashMap('paste');
        $ovens    = ProductAttribute::getHashMap('oven');

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