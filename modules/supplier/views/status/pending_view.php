<?php

use app\assets\AppAsset;

AppAsset::register($this);

/**
 
 * @author Leonardo <leonardoesaug@gmail.com>
 */

$this->title = 'Status';
?>
<style>
    .smaller-image {
        max-width: 90%;
        /* Ajusta el valor según lo deseado */
        height: auto;
        margin: 0 auto;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 15px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin-right: 30px;
        margin-left: 30px;
        margin-bottom: 15px;
        text-align: center;
        margin-top: 20px;
    }

    .custom-gender {
        padding: none;
    }
</style>


<div class="right-sidebar-box card">
    <div class="card-body">


        <h2 class="card-title">Estado de la solicitud: En Revision</h2>
        <p class="card-text">Estamos revisando tus datos, este proceso puede tardar un poco</p>
        <img src="/template/images/espera.jpg" alt="Proceso de Aceptación" class="smaller-image" style="max-width: 50%; ">
    </div>

</div>