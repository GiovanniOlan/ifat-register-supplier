<?php

/*
 * This file is part of the 2amigos/yii2-usuario project.
 *
 * (c) 2amigOS! <http://2amigos.us/>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use app\utils\helpers\GenderHelper;

/** @var yii\web\View $this */
/** @var string[] $params */
/** @var app\models\User $user */
/** @var app\models\Person $person */
/** @var \Da\User\Module $module */

?>

<?php if (!$person->isNewRecord) : ?>
    <?php $this->beginContent($module->viewPath . '/admin/update.php', ['user' => $user]); ?>

    <?php $form = ActiveForm::begin(
        [
            'layout' => 'horizontal',
            'enableAjaxValidation' => false,
            'enableClientValidation' => true,
        ]
    ); ?>
<?php endif; ?>


<?= $form->field($person, 'per_name') ?>

<?= $form->field($person, 'per_lastname_paternal') ?>
<?= $form->field($person, 'per_lastname_maternal') ?>

<?= $form->field($person, 'per_gender')
    ->dropDownList(GenderHelper::map(), [
        'class' => 'form-control',
        'prompt' => 'Selecciona una opción',
    ]) ?>


<?php if (!$person->isNewRecord) : ?>
    <div class="form-group">
        <div class="offset-sm-2 col-lg-10">
            <div class="d-grid">
                <?= Html::submitButton(
                    Yii::t('usuario', 'Update'),
                    ['class' => 'btn btn-success']
                ) ?>
            </div>
        </div>
    </div>
<?php endif; ?>


<?php if (!$person->isNewRecord) : ?>
    <?php ActiveForm::end(); ?>

    <?php $this->endContent(); ?>
<?php endif; ?>