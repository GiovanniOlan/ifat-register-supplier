<?php

namespace app\utils\helpers;

use app\utils\helpers\ConstantValuesHelper;


class GenderHelper extends ConstantValuesHelper
{
    const FEMALE_VALUE = 1;
    const MALE_VALUE = 2;

    public static $values = [
        [
            'value' => self::FEMALE_VALUE,
            'label' => 'Femenino',
            // 'html' => '<span class="badge bg-danger">' . 'Cancelado' . '</span>'
        ],
        [
            'value' => self::MALE_VALUE,
            'label' => 'Masculino',
            // 'html' => '<span class="badge bg-warning">' . 'En Curso' . '</span>'
        ],
    ];
}
