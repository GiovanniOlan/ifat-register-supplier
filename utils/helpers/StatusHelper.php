<?php

namespace app\utils\helpers;

use app\utils\helpers\ConstantValuesHelper;

class StatusHelper extends ConstantValuesHelper
{
    const INACTIVE_VALUE = 1;
    const ACTIVE_VALUE = 2;

    public static $values = [
        [
            'value' => self::INACTIVE_VALUE,
            'label' => 'Inactivo',
            'html' => '<span class="badge bg-danger">' . 'Inactivo' . '</span>'
        ],
        [
            'value' => self::ACTIVE_VALUE,
            'label' => 'Activo',
            'html' => '<span class="badge bg-success">' . 'Activo' . '</span>'
        ],
    ];
}
