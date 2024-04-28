<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>

<h1><?= Html::encode($this->title) ?></h1>
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
<div style="margin-top: 20px;"></div>
<div class="right-sidebar-box card">
    <h3 style="color: #235b4e;">A continuación agrega todos tus productos</h3>

    <div class="row mt-3">
        <?php foreach ($products as $product) : ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
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