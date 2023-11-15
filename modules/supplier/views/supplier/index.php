<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

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
                    <h5 class="card-title text-center mb-4">Registro</h5>

                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($supplier, 'sup_rfc', [
                        'inputOptions' => [
                            'maxlength' => true,
                            'class' => 'form-control form-control-lg rounded-3',
                            'placeholder' => 'Ingrese su RFC'
                        ]
                    ])->textInput() ?>

                    <div class="form-group text-center mt-4">
                        <?= Html::submitButton('Registrarse', ['class' => 'btn btn-success rounded-pill px-5']) ?>
                        <?= Html::submitButton('Dar Seguimiento', ['class' => 'btn btn-success rounded-pill px-5']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>