<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;


// Define los enlaces de breadcrumbs
$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = 'Datos personales';

$this->title = 'Datos personales';
?>


<h1><?= Html::encode($this->title) ?></h1>

<div class="create">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->label('Nombre') ?>
    <?= $form->field($model, 'lastNamePaternal')->label('Apellido Paterno') ?>
    <?= $form->field($model, 'lastNameMaternal')->label('Apellido Materno') ?>
    <?= $form->field($model, 'gender')->dropDownList(['' => 'Selecciona tu género', '1' => 'Masculino', '2' => 'Femenino'])->label('Género') ?>
    <?= $form->field($model, 'phone')->label('Teléfono') ?>
    <?= $form->field($model, 'curp')->label('CURP')->textInput(['maxlength' => 18]) ?>
    <?= $form->field($model, 'rfc')->label('RFC')->textInput(['maxlength' => 13]) ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>