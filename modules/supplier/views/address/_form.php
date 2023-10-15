<?php

use yii\web\View;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\Address $address
 * @var app\models\Colonia $colonia
 *
 * @author Leonardo <leonardoesaug@gmail.com>
 */

$this->params['breadcrumbs'][] = ['label' => 'Inicio', 'url' => ['/site/index']];
$this->params['breadcrumbs'][] = 'Dirección';

$this->title = 'Dirección';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div class="address-create">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($address, 'postal_code')->textInput(['id' => 'postal_code', 'onchange' => 'getColonias()']) ?>
    <?= $form->field($address, 'add_fkcolonia')->dropDownList([], ['prompt' => 'Seleccione una colonia', 'id' => 'add_fkcolonia']) ?>
    <?= $form->field($address, 'add_street')->textInput() ?>
    <?= $form->field($address, 'add_exterior')->textInput() ?>
    <?= $form->field($address, 'add_interior')->textInput() ?>
    <?= $form->field($address, 'add_note')->textarea(['rows' => 4]) ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

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