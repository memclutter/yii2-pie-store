<?php

namespace app\controllers;

use app\models\ProductAttribute;
use Yii;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @param null $attributes
     * @return mixed
     */
    public function actionIndex($attributes = null)
    {
        $attributes = array_filter(explode('/', $attributes), 'trim');

        $searchModel = new ProductSearch();
        foreach ($attributes as $attribute) {
            if (false !== $type = ProductAttribute::getAttributeType($attribute)) {
                $searchModel->{$type . '_id'} = $attribute;
            }
        }
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
