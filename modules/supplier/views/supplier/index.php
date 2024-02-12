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
<section class="home-search-full pt-0 overflow-hidden">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-12">
                <div class="slider-animate">
                    <div>
                        <div class="home-contain rounded-0 p-0">
                            <img src="/template/images/vegetable/bg-img.jpg" class="img-fluid bg-img blur-up lazyload bg-top" alt="">
                            <div class="home-detail p-center text-center home-overlay position-relative">
                                <div>
                                    <div class="content">
                                        <h1>Inicia tu Registro</h1>
                                        <div class="search-box">
                                        <?php $form = ActiveForm::begin(); ?>

                                            <?= $form->field($supplier, 'sup_rfc', [
                                                'inputOptions' => [
                                                    'maxlength' => true,
                                                    'class' => 'form-control form-control-lg rounded-3',
                                                    'placeholder' => 'Ingresa tu RFC'
                                                ]
                                            ])->textInput() ?>

                                            <div class="form-group text-center mt-4">
                                                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
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