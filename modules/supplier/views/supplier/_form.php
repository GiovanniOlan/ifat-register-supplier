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
<?php

$totalSteps = 3;
$currentStep = 1;
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
?>

<div class="progress-cont">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: <?= $progressPercentage ?>%;" aria-valuenow="<?= $progressPercentage ?>" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-title"><?= $progressTitle ?></div>
        </div>
    </div>
</div>


<div class="create">

    <section class="contact-box-section">
        <div class="right-sidebar-box">


            <?php $form = ActiveForm::begin([
                'enableClientValidation' => true,
                // 'enableAjaxValidation' => true,
            ]); ?>

            <div class="row">
                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($supplier, 'sup_rfc')->textInput([
                                'disabled' => !$supplier->isAttributeActive('sup_rfc')
                            ]) ?>
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($person, 'per_name') ?>
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">

                        <div class="custom-input">
                            <?= $form->field($person, 'per_lastname_paternal') ?>
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($person, 'per_lastname_maternal') ?>
                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-gender">
                            <?= $form->field($person, 'per_gender')->dropDownList(GenderHelper::map(), ['prompt' => 'Seleccione un género']) ?>
                            <i class="fa-solid fa-venus-mars"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($supplier, 'sup_phone', [
                                'inputOptions' => ['maxlength' => 10],
                                'enableAjaxValidation' => true,
                            ]) ?>
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($user, 'email', [
                                'enableAjaxValidation' => true,
                            ]) ?>
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6 col-lg-12 col-sm-6">
                    <div class="mb-md-4 mb-3 custom-form">
                        <div class="custom-input">
                            <?= $form->field($supplier, 'sup_curp', [
                                'inputOptions' => ['maxlength' => 18],
                                'enableAjaxValidation' => true,
                            ]) ?>
                            <i class="fa-solid fa-key"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </section>



</div>