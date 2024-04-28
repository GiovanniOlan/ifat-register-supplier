<?php

namespace app\utils\helpers;

use app\utils\helpers\ConstantValuesHelper;

class StatusHelper extends ConstantValuesHelper
{
    const PENDING_VALUE = 1;
    const ACTIVE_VALUE =  2;
    const INACTIVE_VALUE = 3;


    public static $values = [
        [
            'value' => self::PENDING_VALUE,
            'label' => 'Pendiente',
            'html' => '<span class="badge bg-danger">' . 'Pendiente' . '</span>'
        ],
        [
            'value' => self::ACTIVE_VALUE,
            'label' => 'Activo',
            'html' => '<span class="badge bg-success">' . 'Activo' . '</span>'
        ],
        [
            'value' => self::INACTIVE_VALUE,
            'label' => 'Inactivo',
            'html' => '<span class="badge bg-danger">' . 'Inactivo' . '</span>'
        ],
    ];
}
