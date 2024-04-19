<?php

use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);

/**
 * @var yii\web\View $this
 * @var app\models\Address $address
 * @var app\models\Colonia $colonia
 *
 * @author Leonardo <leonardoesaug@gmail.com>
 */
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="address-create">
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            margin-right: 30px;
            margin-left: 30px;
            margin-bottom: 15px;
        }
    </style>
    <section class="contact-box-section">
        <div class="right-sidebar-box card">

            <h3 style="color: #235b4e;">Direccion</h3>

            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'postal_code')->textInput(['id' => 'postal_code', 'onchange' => 'getColonias()']) ?>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-gender">
                            <?= $form->field($address, 'add_fkcolonia')->dropDownList([], ['prompt' => 'Seleccione una colonia', 'id' => 'add_fkcolonia']) ?>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_street')->textInput() ?>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_exterior')->textInput() ?>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_interior')->textInput() ?>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-4 col-lg-4 col-sm-12">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_note')->textarea(['rows' => 4]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" form-group">
                <?= Html::submitButton('Siguiente', ['class' => 'btn btn-primary', 'style' => 'background-color: #235b4e; color: white;']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </section>

</div>

<?php
$this->registerJs(
    <<<JS
        function getColonias() {
            var postal_code = $('#postal_code').val();

            $.ajax({
                url: '/supplier/address/get-colonias',
                type: 'post',
                data: {
                    postal_code: postal_code
                },
                success: function(response) {
                    if (response.success) {
                        $('#add_fkcolonia').empty();
                        $.each(response.colonias, function(key, value) {
                            $('#add_fkcolonia').append($('<option>', {
                                value: key,
                                text: value
                            }));
                        });
                    }
                }
            });
        }
    JS,
    View::POS_END
)
?>