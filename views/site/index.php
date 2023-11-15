<?php

use yii\bootstrap5\Html;

/** @var yii\web\View $this */

$this->title = 'aa';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Congratulationsaaaaaaaaa!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <!-- <p><a class="btn btn-lg btn-success" href="http://ifat-register-supplier.test/supplier/register/personal">Iniciar registro</a></p> -->
        <!-- <p><a class="btn btn-lg btn-success" href="http://ifat-register-supplier.test/supplier/list">Ver usuarios</a></p> -->

        <p>
            <?= Html::a('Iniciar Registro', ['/supplier/register'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Iniciar Sistema', ['/supplier/search'], ['class' => 'btn btn-primary']) ?>
        </p>
    </div>
</div>