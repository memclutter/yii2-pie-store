<?php

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
    ]); ?>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'title') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'price') ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'available_count') ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
