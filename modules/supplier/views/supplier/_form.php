<?php

use app\utils\helpers\GenderHelper;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);

/**
 * @var yii\web\View $this 
 * @var app\models\Person $person
 * @var app\models\Supplier $supplier
 * @var app\models\User $user
 * 
 * @author Leonardo <leonardoesaug@gmail.com>
 */



$this->title = 'Datos personales';
?>


<div class="create">

    <section class="contact-box-section">
        <div class="right-sidebar-box card-questionnaire">


            <?php $form = ActiveForm::begin([
                'enableClientValidation' => true,
                // 'enableAjaxValidation' => true,
            ]); ?>
            <h3 style="color: #235b4e;">Tus datos personales</h3>


            <div class="row">
                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($supplier, 'sup_curp')->textInput([
                                'disabled' => !$supplier->isAttributeActive('sup_curp')
                            ]) ?>

                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($person, 'per_name') ?>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($person, 'per_lastname_paternal') ?>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($person, 'per_lastname_maternal') ?>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-gender">
                            <?= $form->field($person, 'per_gender')->dropDownList(GenderHelper::map(), ['prompt' => 'Seleccione un género']) ?>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($supplier, 'sup_phone', [
                                'inputOptions' => [
                                    'maxlength' => 10,
                                    'style' => 'border: none; font-size: 14px; padding: calc(8px + (14 - 8) * ((100vw - 320px) / (1920 - 320))); line-height: 1.5; width: 100%; border-radius: 0.25rem;'
                                ],
                                'enableAjaxValidation' => true,
                            ]) ?>
                        </div>
                    </div>
                </div>


                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($user, 'email', [
                                'enableAjaxValidation' => true,
                            ]) ?>

                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($supplier, 'sup_rfc', [
                                'inputOptions' => [
                                    'maxlength' => 13,
                                    'style' => 'border: none; font-size: 14px; padding: calc(8px + (14 - 8) * ((100vw - 320px) / (1920 - 320))); line-height: 1.5; width: 100%; border-radius: 0.25rem;'
                                ],
                                'enableAjaxValidation' => true,
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Siguiente', ['class' => 'btn btn-primary', 'style' => 'background-color: #235b4e; color: white;']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </section>




</div>