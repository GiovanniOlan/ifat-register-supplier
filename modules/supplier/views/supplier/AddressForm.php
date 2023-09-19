<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = ['label' => 'Datos personales', 'url' => ['personal']];
$this->params['breadcrumbs'][] = 'Dirección';

$this->title = 'Dirección';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="create">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'colonia')->label('Colonia') ?>
    <?= $form->field($model, 'street')->label('Calle') ?>
    <?= $form->field($model, 'exterior')->label('Número Exterior') ?>
    <?= $form->field($model, 'interior')->label('Número Interior') ?>
    <?= $form->field($model, 'note')->label('Notas de dirección') ?>



    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>