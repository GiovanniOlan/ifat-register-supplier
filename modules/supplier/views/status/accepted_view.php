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
        <h2 class="card-title">Felicidades, has pasado el primer filtro!</h2>
        <p class="card-text">Has concluido correctamente el proceso de pre-selección, ahora deberás presentarte en las oficinas del ifat ubicadas en Prol. de Paseo de la Sierra #820 Col. Primero de Mayo, C.P. 86190 Villahermosa, Tabasco, MX</p>
        <?php if ($acceptedMessage) : ?>
            <?php
            $meetingDate = new DateTime($acceptedMessage->mess_meeting_day);
            $formattedMeetingDate = $meetingDate->format('l, d-m-Y');
            $meetingTime = new DateTime($acceptedMessage->mess_meeting_time);
            $formattedMeetingTime = $meetingTime->format('h:i A');
            ?>
            <p class="card-text">Fecha de reunión: <?= $formattedMeetingDate ?></p>
            <p class="card-text">Hora de reunión: <?= $formattedMeetingTime ?></p>
        <?php endif; ?>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3795.1675599033315!2d-92.93414012666527!3d17.970939685735935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85edd9d13edd83e5%3A0x87ab852ac6687819!2sInstituto%20para%20el%20Fomento%20de%20las%20Artesan%C3%ADas%20de%20Tabasco!5e0!3m2!1ses-419!2smx!4v1714343003300!5m2!1ses-419!2smx" width="900" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>


</div>