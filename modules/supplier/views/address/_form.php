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
<?php

$totalSteps = 3;
$currentStep = 2;
$progressPercentage = ($currentStep / $totalSteps) * 100;

// Determinar el título de la barra de progreso según el paso actual
$progressTitle = '';
if ($currentStep == 1) {
    $progressTitle = 'Datos Personales';
} elseif ($currentStep == 2) {
    $progressTitle = 'Dirección';
} elseif ($currentStep == 3) {
    $progressTitle = 'aaa';
}
?> <div class="progress-cont">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: <?= $progressPercentage ?>%;" aria-valuenow="<?= $progressPercentage ?>" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-title"><?= $progressTitle ?></div>
        </div>
    </div>
</div>
<div class="address-create">

    <section class="contact-box-section">
        <div class="right-sidebar-box">


            <?php $form = ActiveForm::begin(); ?>

            <div class="row">
                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'postal_code')->textInput(['id' => 'postal_code', 'onchange' => 'getColonias()']) ?>
                            <i class="fa-solid fa-map"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-gender">
                            <?= $form->field($address, 'add_fkcolonia')->dropDownList([], ['prompt' => 'Seleccione una colonia', 'id' => 'add_fkcolonia']) ?>
                            <i class="fa-solid fa-map-pin"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_street')->textInput() ?>
                            <i class="fa-solid fa-road"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_exterior')->textInput() ?>
                            <i class="fa-solid fa-house"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_interior')->textInput() ?>
                            <i class="fa-solid fa-house"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($address, 'add_note')->textarea(['rows' => 4]) ?>
                            <i class="fa-solid fa-sticky-note"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
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