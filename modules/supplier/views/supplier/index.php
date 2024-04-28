<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\ActiveForm;

AppAsset::register($this);

/**
 * @var yii\web\View $this 
 * @var app\models\Supplier $supplier
 * 
 * @author Leonardo <leonardoesaug@gmail.com>
 */

$this->title = 'Búsqueda';
?>
<style>
    .card {
        /* background-color: blue;background: linear-gradient(to right, #6B71E4, #53B3C6); */
        background-color: #dbece3;
    }
</style>
<section class="home-search-full pt-0 overflow-hidden">

    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="slider-animate">
                    <div>
                        <div class="home-contain rounded-0 p-0">
                            <img src="/template/images/vegetable/DSC_5681.jpg" class="img-fluid bg-img blur-up lazyload bg-top" alt="">
                            <div class="home-detail p-center text-center home-overlay position-relative">
                                <div>
                                    <div class="content card">
                                        <h2 style="color: #235b4e;">¿Quieres formar parte de nuestro padrón de artesanos?</h2>
                                        <h3 style="color: #235b4e;">Escribe tu CURP para registrarte o consultar el estatus de tu solicitud</h3>
                                        <div class="search-box">
                                            <?php $form = ActiveForm::begin(); ?>
                                            <?= $form->field($supplier, 'sup_curp', [
                                                'inputOptions' => [
                                                    'maxlength' => true,
                                                    'class' => 'form-control form-control-lg rounded-3',
                                                    'placeholder' => 'Ingresa tu CURP',
                                                    'style' => 'background-color: #D8EED9;'
                                                ],
                                            ])->label(false)->textInput() ?>

                                            <div class="form-group text-center mt-4">
                                                <div class="botones-group" style="display: flex; justify-content: center;">
                                                    <?= Html::submitButton('Iniciar Registro', ['class' => 'btn btn-primary mx-3', 'style' => 'background-color: #235b4e; color: white;']) ?>
                                                    <?= Html::submitButton('Consultar tu status', ['class' => 'btn btn-primary mx-3', 'style' => 'background-color: #235b4e; color: white;']) ?>
                                                    <!-- colores235b4e -->
                                                </div>
                                            </div>
                                            <?php ActiveForm::end(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>