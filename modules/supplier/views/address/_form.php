<?php

use app\models\Colonia;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View $this 
 * @var app\models\Address $address
 * @var app\models\Colonia $colonia
 * 
 * @author Leonardo <leonardoesaug@gmail.com>
 */


// $this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['/site/index']];
// $this->params['breadcrumbs'][] = ['label' => 'Datos personales', 'url' => ['personal']];
// $this->params['breadcrumbs'][] = 'Dirección';

$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = 'Dirección';

$this->title = 'Dirección';

$colonia = Colonia::findOne($address->add_fkcolonia);

?>


<h1><?= Html::encode($this->title) ?></h1>

<div class="create">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($address, 'add_fkcolonia')->textInput() ?>
    <?= $form->field($address, 'add_street') ?>
    <?= $form->field($address, 'add_exterior') ?>
    <?= $form->field($address, 'add_interior') ?>
    <?= $form->field($address, 'add_note') ?>


    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>