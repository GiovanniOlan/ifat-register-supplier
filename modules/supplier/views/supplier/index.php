<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);

/**
 * @var yii\web\View $this 
 * @var app\models\Supplier $supplier
 * 
 * @author Leonardo <leonardoesaug@gmail.com>
 */

$this->title = 'Búsqueda';
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4 font-weight-bold ">Inicia Tu Registro</h3>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($supplier, 'sup_rfc', [
                        'inputOptions' => [
                            'maxlength' => true,
                            'class' => 'form-control form-control-lg rounded-3',
                            'placeholder' => 'Ingrese su RFC'
                        ]
                    ])->textInput() ?>

                    <div class="form-group text-center mt-4">
                        <?= Html::submitButton('Registrarse', ['class' => 'btn btn-primary']) ?>
                        <?= Html::submitButton('Dar Seguimiento', ['class' => 'btn btn-primary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>