<?php

namespace app\commands;

use app\models\Product;
use Faker\Factory;
use yii\console\Controller;
use yii\console\Exception;

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

        for ($i = 0; $i < $count; $i++) {
            $product = new Product();

            $product->title           = $faker->words(2, true);
            $product->description     = $faker->text(200);
            $product->price           = $faker->randomFloat(2, 0.10, 1000);
            $product->available_count = $faker->randomDigit;

            if (!$product->save()) {
                throw new Exception("Failed to save Product\n\n" .
                    print_r($product->getErrors(), true));
            }

            $this->stdout("'{$product->title}' saved ...\n");
        }
    }
}