<?php

use app\models\ProductAttribute;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'catalog-search-form',
        ],
    ]); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form
                ->field($model, 'size_id')
                ->label($model->getAttributeLabel('size'))
                ->dropDownList(
                    ProductAttribute::getHashMap('size'),
                    [
                        'prompt' => '',
                    ]
                )
            ?>
        </div>
        <div class="col-sm-4">
            <?= $form
                ->field($model, 'stuffing_id')
                ->label($model->getAttributeLabel('stuffing'))
                ->dropDownList(
                    ProductAttribute::getHashMap('stuffing'),
                    [
                        'prompt' => ''
                    ]
                )
            ?>
        </div>
        <div class="col-sm-4">
            <?= $form
                ->field($model, 'target_id')
                ->label($model->getAttributeLabel('target'))
                ->dropDownList(
                    ProductAttribute::getHashMap('target'),
                    [
                        'prompt' => ''
                    ]
                )
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form
                ->field($model, 'paste_id')
                ->label($model->getAttributeLabel('paste'))
                ->dropDownList(
                    ProductAttribute::getHashMap('paste'),
                    [
                        'prompt' => ''
                    ]
                )
            ?>
        </div>
        <div class="col-sm-8">
            <?= $form
                ->field($model, 'oven_id')
                ->label($model->getAttributeLabel('oven'))
                ->dropDownList(
                    ProductAttribute::getHashMap('oven'),
                    [
                        'prompt' => ''
                    ]
                )
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
