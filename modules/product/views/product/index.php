<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap5\ActiveForm;

AppAsset::register($this);

/* @var $this yii\web\View */
/* @var $product app\models\Product */
/* @var $form yii\widgets\ActiveForm */
/**
 
 *
 * @author Leonardo <leonardoesaug@gmail.com>
 */

$this->title = 'Productos';
?>
<style>
    .btn-delete-product {
        background-color: #9D2449;
    }
</style>
<div style="margin-top: 20px;"></div>
<div class="right-sidebar-box card-questionnaire">
    <h3 style="color: #235b4e;">A continuación agrega todos tus productos</h3>

    <div class="row mt-3">
        <?php foreach ($products as $product) : ?>
            <div class="col-md-4">
                <div class="mb-3">
                    <div class="card-product-index">
                        <div class="position-relative">
                            <!-- Botón de eliminación -->
                            <div style="position: absolute; top: 10px; right: 10px;">
                                <?= Html::a('<i class="fas fa-trash-can"></i>', ['product/delete', 'id' => $product->pro_id], [
                                    'class' => 'btn btn-danger btn-sm btn-delete-product',
                                    'data' => [
                                        'confirm' => '¿Estás seguro de que quieres eliminar este producto?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </div>
                            <?php
                            // Ruta de la imagen
                            $productImages = $product->productImages;
                            $firstProductImage = !empty($productImages) ? $productImages[0] : null;
                            ?>
                            <?php if ($firstProductImage) : ?>
                                <?= Html::img($firstProductImage->proima_path, ['class' => 'card-img-top', 'alt' => 'Product Image']) ?>

                            <?php else : ?>
                                <p class='no-image'>No se encontró ninguna imagen para este producto.</p>
                            <?php endif; ?>
                            <h3 class="card-title">Nombre: <?= Html::encode($product->pro_name) ?></h3>
                            <h3 class="card-title">Descripción: <?= Html::encode($product->pro_description) ?></h3>
                            <!-- <h3 class="card-title">Tipo de producto: <?= isset($craftTypes[$product->pro_is_craft]) ? $craftTypes[$product->pro_is_craft] : 'Desconocido' ?></h3> -->
                            <?php if (isset($productLineAssignments[$product->pro_id])) : ?>
                                <?php foreach ($productLineAssignments[$product->pro_id] as $lineAssignment) : ?>
                                    <?php foreach ($lineTypes as $lineType) : ?>
                                        <?php if ($lineAssignment->clias_fkline === $lineType->clin_id) : ?>
                                            <h3 class="card-title">Línea del producto: <?= $lineType->clin_name ?></h3>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class=" mt-3 d-flex justify-content-start">
        <?= Html::a('Agregar Producto', ['product/create', 'id' => $id], ['class' => 'btn btn-success mr-2', 'style' => 'background-color: #235b4e; color: white;']) ?>

        <?php if ($hasProducts) : ?>
            <?php $form = ActiveForm::begin(); ?>
            <?= Html::submitButton('Finalizar Registro', ['name' => 'finalize_registration', 'value' => 'finalize', 'class' => 'btn btn-primary', 'style' => 'background-color: #75172A; color: white;', 'onclick' => 'return confirm("¿Estás seguro que deseas finalizar el registro?");']) ?>
            <?php ActiveForm::end(); ?>
        <?php endif; ?>
    </div>

</div>