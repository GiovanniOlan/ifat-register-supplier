<?php

use app\utils\helpers\GenderHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View $this 
 * @var app\models\Person $person
 * @var app\models\Supplier $supplier
 * @var app\models\User $user
 * 
 * @author Leonardo <leonardoesaug@gmail.com>
 */

$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = 'Datos personales';

$this->title = 'Datos personales';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="create">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => true,
        // 'enableAjaxValidation' => true,
    ]); ?>

    <?= $form->field($person, 'per_name') ?>
    <?= $form->field($person, 'per_lastname_paternal') ?>
    <?= $form->field($person, 'per_lastname_maternal') ?>
    <?= $form->field($person, 'per_gender')->dropDownList(GenderHelper::map(), []) ?>
    <?= $form->field($supplier, 'sup_phone') ?>
    <?= $form->field($user, 'email') ?>
    <?= $form->field($supplier, 'sup_rfc', [
        'enableAjaxValidation' => true,
    ]) ?>
    <?= $form->field($supplier, 'sup_curp') ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>