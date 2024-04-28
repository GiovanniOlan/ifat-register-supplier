<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<style>
    body {
        color: #566787;
        background: #f5f5f5;
        font-family: 'Varela Round', sans-serif;
        font-size: 13px;
    }

    .table-responsive {
        margin: 30px 0;
    }

    .table-wrapper {
        min-width: 1000px;
        background: #fff;
        padding: 20px 25px;
        border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
    }

    .table-title {
        padding-bottom: 15px;
        background: #299be4;
        color: #fff;
        padding: 16px 30px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }

    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }

    .table-title .btn {
        color: #566787;
        float: right;
        font-size: 13px;
        background: #fff;
        border: none;
        min-width: 50px;
        border-radius: 2px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }

    .table-title .btn:hover,
    .table-title .btn:focus {
        color: #566787;
        background: #f2f2f2;
    }

    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }

    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }

    table.table tr th,
    table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }

    table.table tr th:first-child {
        width: 60px;
    }

    table.table tr th:last-child {
        width: 100px;
    }

    table.table-striped tbody tr:nth-of-type(odd) {
        background-color: #fcfcfc;
    }

    table.table-striped.table-hover tbody tr:hover {
        background: #f5f5f5;
    }

    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }

    table.table td:last-child i {
        opacity: 0.9;
        font-size: 22px;
        margin: 0 5px;
    }

    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }

    table.table td a:hover {
        color: #2196F3;
    }

    table.table td a.settings {
        color: #2196F3;
    }

    table.table td a.delete {
        color: #F44336;
    }

    table.table td i {
        font-size: 19px;
    }

    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }

    .status {
        font-size: 30px;
        margin: 2px 2px 0 0;
        display: inline-block;
        vertical-align: middle;
        line-height: 10px;
    }

    .text-success {
        color: #10c469;
    }

    .text-info {
        color: #62c9e8;
    }

    .text-warning {
        color: #FFC107;
    }

    .text-danger {
        color: #ff5b5b;
    }

    .pagination {
        float: right;
        margin: 0 0 5px;
    }

    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }

    .pagination li a:hover {
        color: #666;
    }

    .pagination li.active a,
    .pagination li.active a.page-link {
        background: #03A9F4;
    }

    .pagination li.active a:hover {
        background: #0397d6;
    }

    .pagination li.disabled i {
        color: #ccc;
    }

    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }

    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }

    .questionnaire-table {
        width: 100%;
        border-collapse: collapse;
    }

    .questionnaire-table th,
    .questionnaire-table td {
        padding: 1px;
        border: 1px solid #ddd;
        text-align: center;
        font-size: xx-small;
    }

    .questionnaire-table th {
        background-color: #235b4e;
        color: white;
    }

    .questionnaire-table td {
        background-color: #f2f2f2;
    }

    .questionnaire-table td.highlight {
        background-color: #4CAF50;
    }

    .questionnaire-table input[type="radio"]:checked+label {
        color: green;
        font-weight: bold;
    }

    .image-file {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        row-gap: 20px;
        margin-bottom: 20px;
        position: relative;
        /* Establece la posición relativa */
        z-index: 1;
        /* Asegúrate de que el z-index sea menor que el del navbar */
    }

    .image-file__action {
        width: 100%;
    }

    .image-file__action label {
        display: block;
    }

    .image-file__action label.title {
        width: 100%;
        margin-bottom: 15px;
        text-align: center;
    }

    .image-file__action input {
        width: 0;
        height: 0;
        opacity: 0;
        display: none;
    }

    .image-file__result {
        cursor: pointer;
        overflow: hidden;
        position: relative;
        width: 90%;
        height: 150px;
        background-color: #f2f0f0;
        border-radius: 8px;
        border: 1px dashed #609dd6;
        transition: bacgroundColor 0.3s linear;
        z-index: 10;
    }

    .image-file__result::after {
        content: 'Clic para elegir imagen.';
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        height: 100%;
        width: 100%;
        color: #609dd6;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-file__result img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 50;
    }


    .questionnaire-table td.selected {
        background-color: greenyellow;
    }

    input[type="radio"] {
        display: none;
    }

    input[type="radio"]:checked+label {
        color: blue;
    }

    .questionnaire-table {
        table-layout: fixed;
    }

    .questionnaire-table tbody tr:nth-child(2) th {
        padding: 0;
        /* Elimina el relleno */
    }

    .product-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .image-container {
        flex: 0 0 auto;
        margin-right: 20px;
    }

    .info-container {
        flex: 1 1 auto;
    }

    .logo-container {
        flex: 0 0 auto;
        margin-left: 20px;
    }

    .product-image {
        max-width: 200px;
    }

    .logo-image {
        max-width: 150px;
    }

    .no-image {
        font-style: italic;
        color: #999;
    }

    .alert {
        margin-bottom: 10px;
    }

    .rounded-border {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 2px 5px;
        /* Ajusta el padding según sea necesario */
    }

    .rounded-border {
        background-color: #f2f2f2;
        /* Color de fondo gris claro */
        border: none;
        /* Elimina el borde */
        border-radius: 10px;
        padding: 2px 5px;
        /* Ajusta el padding según sea necesario */
    }

    .button-container {
        display: flex;
        /* Establece el contenedor como un flex container */
    }

    .button-container>* {
        margin-right: 10px;
        /* Espacio entre los botones */
    }

    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        /* Ancho reducido */
    }
</style>

<div class="row">

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Proveedores Registrados Hoy</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countSuppliersToday ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Proveedores Totales Registrados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countTotalSuppliers ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Productos Totales Registrados</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countTotalProduct ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Proveedores por validar </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $countActiveSuppliers ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="container">
            <h1 class="title"><?= $person->per_name ?> <?= $person->per_lastname_paternal ?> <?= $person->per_lastname_maternal ?></h1>
            <?php if ($supplier = $user->suppliers[0] ?? null) : ?>
                <?php if ($supplier->sup_finished == 1) : ?>
                    <div class="alert alert-warning" role="alert">
                        Este candidato no ha finalizado su registro.
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <p><span class="rounded-border"><strong>Género:</strong> <?= ($person->per_gender == 1) ? 'Masculino' : 'Femenino' ?></span> &nbsp;&nbsp;&nbsp;
                <span class="rounded-border"><strong>Teléfono:</strong> <?= $supplier->sup_phone ?></span> &nbsp;&nbsp;&nbsp; <span class="rounded-border"><strong>CURP:</strong> <?= $supplier->sup_curp ?></span> &nbsp;&nbsp;&nbsp; <span class="rounded-border"><strong>RFC:</strong> <?= $supplier->sup_rfc ?></span>
            </p>
            <h2> Dirección </h2>
            <?php if (!empty($user->addresses)) : ?>
                <?php $address = $user->addresses[0]; ?>
                <?php if ($colonia = $address->addFkcolonia) : ?>
                    <p>
                        <span class="rounded-border"><strong>Calle:</strong> <?= $address->add_street ?></span>
                        <span class="rounded-border"><strong>Número Exterior:</strong> <?= $address->add_exterior ?></span> &nbsp;&nbsp;&nbsp;
                        <span class="rounded-border"><strong>Número Interior:</strong> <?= $address->add_interior ?></span> &nbsp;&nbsp;&nbsp;
                    </p>
                    <p><span class="rounded-border"><strong>Colonia:</strong> <?= $colonia->nombre ?></span> &nbsp;&nbsp;&nbsp;
                        <span class="rounded-border"><strong>Código Postal:</strong> <?= $colonia->codigo_postal ?></span> &nbsp;&nbsp;&nbsp;
                        <span class="rounded-border"><strong>Nota:</strong> <?= $address->add_note ?></span>
                    </p>
                <?php endif; ?>

            <?php else : ?>
                <p>No ha registrado una dirección</p>
            <?php endif; ?>
            <p><strong>Estado:</strong> <?= ($supplier->sup_status == 1) ? 'En revisión' : (($supplier->sup_status == 2) ? 'Aceptado' : (($supplier->sup_status == 3) ? 'Rechazado' : 'Desconocido')) ?></p>

            <?php if ($supplier->sup_status == 1) : ?>
                <button class="btn btn-danger" id="rejectBtn">Rechazar</button>
                <button class="btn btn-success" id="acceptBtn">Aceptar</button>
                <button class="btn btn-secondary" id="cancelBtn">Cancelar</button>
            <?php endif; ?>

            <div id="rejectFormContainer" style="display: none;">
                <div style="margin-top: 10px;"></div>

                <?php $form = ActiveForm::begin(['action' => ['administration/reject-supplier', 'id' => $user->id], 'id' => 'rejectForm']); ?>
                <?= $form->field($messageModel, 'mess_reason')->textarea(['rows' => 4]) ?>
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
            <div id="acceptFormContainer" style="display: none;">
                <?php $form = ActiveForm::begin(['action' => ['administration/accept-supplier', 'id' => $user->id], 'id' => 'acceptForm']); ?>
                <div style="margin-top: 10px;"></div>
                <div class="form-inline">
                    <?= $form->field($messageModel, 'mess_meeting_day', ['options' => ['class' => 'mr-3']])->textInput(['type' => 'date', 'class' => 'form-control']) ?>
                    <?= $form->field($messageModel, 'mess_meeting_time', ['options' => ['class' => 'mr-3']])->textInput(['type' => 'time', 'class' => 'form-control']) ?>
                </div>
                <div style="margin-top: 10px;"></div>
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <h2 style="text-align:center; ">Productos Registrados</h2>



        <?php foreach ($products as $product) : ?>
            <div style="margin-top: 20px;"></div>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <div class="product-container">
                                <div class="image-container">
                                    <?php
                                    $productImages = $product->productImages;
                                    $firstProductImage = !empty($productImages) ? $productImages[0] : null;
                                    $catLineAssignments = $product->catLineAssignments;
                                    ?>
                                    <?php if ($firstProductImage) : ?>
                                        <?= Html::img($firstProductImage->proima_path, ['class' => 'product-image', 'alt' => 'Product Image', 'data-toggle' => 'modal', 'data-target' => '#exampleModal_' . $product->pro_id]) ?>
                                    <?php else : ?>
                                        <p class='no-image'>No se encontró ninguna imagen para este producto.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="info-container">
                                    <p><strong>Producto a Evaluar:</strong> <?= $product->pro_name ?></p>
                                    <p><strong>Descripción:</strong> <?= $product->pro_description ?></p>
                                    <?php if (!empty($catLineAssignments)) : ?>
                                        <?php foreach ($catLineAssignments as $catLineAssignment) : ?>
                                            <p><strong>Línea de Categoría:</strong> <?= $catLineAssignment->cliasFkline->clin_name ?></p>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>No se han asignado líneas de categoría a este producto.</p>
                                    <?php endif; ?>
                                </div>
                                <div class="logo-container">
                                    <?= Html::img('@web/upload/images/logo_ifat.jpg', ['class' => 'logo-image', 'alt' => 'Logo']) ?>
                                </div>
                            </div>
                            <?php if (!empty($productImages)) : ?>
                                <div class="modal fade" id="exampleModal_<?= $product->pro_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="max-width: 700px; max-height: 200px">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Imágenes del Producto</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div id="carouselExampleIndicators_<?= $product->pro_id ?>" class="carousel slide" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <?php foreach ($productImages as $index => $productImage) : ?>
                                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                                <?= Html::img($productImage->proima_path, ['class' => 'd-block w-100 img-fluid', 'alt' => 'Product Image', 'style' => 'max-width: 100%;  margin: auto;']) ?>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                    <?php if (count($productImages) > 1) : ?>
                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators_<?= $product->pro_id ?>" role="button" data-slide="prev" style="background-color: rgba(0, 0, 0, 0.5); color: black;">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators_<?= $product->pro_id ?>" role="button" data-slide="next" style="background-color: rgba(0, 0, 0, 0.5); color: white;">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="button-container">
                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse<?= $product->pro_id ?>" aria-expanded="false" aria-controls="collapse<?= $product->pro_id ?>">
                                    Ver cuestionario
                                </button>
                                <div class="btn btn-primary">
                                    <?= Html::a('Descargar PDF', ['download-pdf', 'id' => $product->pro_id], ['class' => 'btn btn-primary']) ?>
                                </div>
                            </div>

                            <div style="margin-top: 10px;"></div>
                            <!-- Colapsable para el cuestionario -->
                            <div class="collapse" id="collapse<?= $product->pro_id ?>">
                                <!-- Primera tabla del cuestionario -->
                                <table class="questionnaire-table" style="table-layout: fixed;">

                                    <thead>
                                        <tr>
                                            <th rowspan="2">Caracteristicas del producto</th>
                                            <th colspan="4" style="text-align: center;">PUNTUACIÓN</th>
                                            <th rowspan="2">VALOR (A)</th>
                                            <th rowspan="2">PRIORIZACIÓN (B)</th>
                                            <th rowspan="2">TOTAL (A*B)</th>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #235b4e;  color: white;">4</td>
                                            <td style="background-color: #235b4e; color: white;">3</td>
                                            <td style="background-color: #235b4e; color: white;">2</td>
                                            <td style="background-color: #235b4e; color: white;">1</td>


                                        </tr>
                                    </thead>
                                    <tbody>

                                        <td style="background-color: #dbece3; color: black;">Origen de la Materia Prima (Principal o inicial)</td>
                                        <?php $options = ['Natural', 'Natural (Procesado industrialmente)', 'Artificial', '            ']; ?>
                                        <?php foreach ($options as $index => $option) : ?>
                                            <?php $answer = 'answer1_' . chr(97 + $index); ?>
                                            <td style="<?= ($product->matrizDam->mdam_question1 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                <?= $option ?>
                                            </td>
                                        <?php endforeach; ?>
                                        <td style="background-color: #dbece3;">
                                            <p>
                                                <?php
                                                $answer = $product->matrizDam->mdam_question1; // Respuesta seleccionada
                                                $points = 0; // Valor inicial de los puntos
                                                switch ($answer) {
                                                    case 'answer1_a':
                                                        $points = 4;
                                                        break;
                                                    case 'answer1_b':
                                                        $points = 3;
                                                        break;
                                                    case 'answer1_c':
                                                        $points = 2;
                                                        break;
                                                }
                                                echo $points;
                                                ?>
                                            </p>
                                        </td>
                                        <td>
                                            <p> 7 </p>
                                        </td>
                                        <td>
                                            <p><?= $points * 7; ?></p>
                                        </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Obtención de la Materia Prima (Principal o inicial)</td>
                                            <?php $options = [
                                                'Siembra/ Cría/ Manejo',
                                                'Recolección/ Extracción',
                                                'Reciclaje',
                                                'Compra'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer2_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question2 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question2; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer2_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer2_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer2_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer2_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 3 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 3; ?></p>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Forma de elaboración de la pieza</td>
                                            <?php $options = [
                                                'Creación total de la pieza',
                                                'Engarzado o cosido manualmente',
                                                'Enfarzado o cosido con máquina',
                                                'Ensamble con pegamento industrial'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer3_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question3 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question3; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer3_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer3_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer3_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer3_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 10 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 10; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Herramientas</td>
                                            <?php $options = [
                                                'Manualmente',
                                                'Herramientas adaptadas por el productor o alguien de la región',
                                                'Maquinaria eléctrica',
                                                'Herramientas comerciales'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer4_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question4 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question4; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer4_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer4_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer4_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer4_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 13 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 13; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Teñido/Pintado</td>
                                            <?php $options = [
                                                'Colorantes, pigmentos naturales / al natural y esmalte para vidriado',
                                                '',
                                                'Material adquirido con color',
                                                'Pinturas industriales',

                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer5_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question5 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question5; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer5_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer5_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer5_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 6 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 6; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Tiempo de elaboración</td>
                                            <?php $options = [
                                                'Más de 24 horas',
                                                'De 9 a 24 horas',
                                                'De 5 a 8 horas',
                                                'Hasta 4 horas'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer6_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question6 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question6; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer6_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer6_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer6_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer6_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 8 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 8; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Diseño del producto</td>
                                            <?php $options = [
                                                'Tradicional',
                                                'Tradicional con Innovación',
                                                'Nuevo / Neoartesanía',
                                                'Estilos'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer7_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question7 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question7; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer7_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer7_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer7_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer7_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 20 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 20; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Representatividad</td>
                                            <?php $options = [
                                                'Local / Región',
                                                'Estado',
                                                'País',
                                                'No es representativo'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer8_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question8 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question8; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer8_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer8_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer8_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer8_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 20 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 20; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Uso del producto</td>
                                            <?php $options = [
                                                'Ceremonia',
                                                'Utilitario',
                                                'Decorativo utilitario',
                                                'Solo decorativo'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer9_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question9 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question9; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer9_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer9_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer9_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer9_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 2 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 2; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">División del trabajo</td>
                                            <?php $options = [
                                                'Por género o por edad',
                                                'Por especialidad',
                                                'Individual',
                                                'Sin división'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer10_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question10 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question10; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer10_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer10_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer10_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer10_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 2 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 2; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="background-color: #dbece3; color: black;">Transmisión del conocimiento</td>
                                            <?php $options = [
                                                'Herencia familiar/Legado cultural',
                                                'Capacitación impartida por una institución o persona externa',
                                                'Autoaprendizaje',
                                                'Cursos'
                                            ]; ?>
                                            <?php foreach ($options as $index => $option) : ?>
                                                <?php $answer = 'answer11_' . chr(97 + $index); ?>
                                                <td style="<?= ($product->matrizDam->mdam_question11 === $answer) ? 'background-color: #dbece3;' : ''; ?>">
                                                    <?= $option ?>
                                                </td>
                                            <?php endforeach; ?>
                                            <td style="background-color: #dbece3;">
                                                <p>
                                                    <?php
                                                    $answer = $product->matrizDam->mdam_question11; // Respuesta seleccionada
                                                    $points = 0; // Valor inicial de los puntos
                                                    switch ($answer) {
                                                        case 'answer11_a':
                                                            $points = 4;
                                                            break;
                                                        case 'answer11_b':
                                                            $points = 3;
                                                            break;
                                                        case 'answer11_c':
                                                            $points = 2;
                                                            break;
                                                        case 'answer11_d':
                                                            $points = 1;
                                                            break;
                                                    }
                                                    echo $points;
                                                    ?>
                                                </p>
                                            </td>
                                            <td>
                                                <p> 9 </p>
                                            </td>
                                            <td>
                                                <p><?= $points * 9; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">
                                                Si el productor pertenece a un grupo étnico que elabora un producto tradicional o tradicional con innovación, agregue 20 puntos
                                            </td>
                                            <td>
                                                <?php
                                                $answer12 = $product->matrizDam->mdam_question12; // Respuesta de la pregunta 12

                                                // Verificar la respuesta y mostrar los puntos correspondientes
                                                if ($answer12 === 'answer12_a') {
                                                    echo "Si: 20";
                                                } elseif ($answer12 === 'answer12_b') {
                                                    echo "No: 0";
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="text-align: right; background-color: #dbece3;">
                                                Total General
                                            </td>
                                            <td style="background-color: green; color: white;">
                                                <?= $product->pro_points ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <!-- Segunda tabla del cuestionario -->
                                <div class="col-6" style="padding-top:1%">
                                    <table class="table questionnaire-table">
                                        <thead>
                                            <tr>
                                                <th colspan="3">Rangos de clasificación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="<?= ($product->pro_points >= 100 && $product->pro_points <= 220) ? 'background-color: green; color: white;' : ''; ?>">
                                                    <p>Manualidad</p>
                                                    <p>De 100 a 220 puntos</p>
                                                </td>
                                                <td style="<?= ($product->pro_points > 220 && $product->pro_points <= 279) ? 'background-color: green; color: white;' : ''; ?>">
                                                    <p>Híbrido</p>
                                                    <p>De 221 a 279 puntos</p>
                                                </td>
                                                <td style="<?= ($product->pro_points > 279 && $product->pro_points <= 420) ? 'background-color: green; color: white;' : ''; ?>">
                                                    <p>Artesanía</p>
                                                    <p>De 280 a 420 puntos</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<script>
    // Mostrar el formulario de rechazo al hacer clic en el botón "Rechazar"
    $('#rejectBtn').click(function() {
        $('#rejectFormContainer').show();
    });
    $(document).ready(function() {
        $('.product-image').click(function() {
            $('#exampleModal').modal('show');
        });
    });
</script>