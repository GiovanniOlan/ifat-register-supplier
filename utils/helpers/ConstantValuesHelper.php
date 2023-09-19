<?php

namespace app\utils\helpers;

use yii\helpers\ArrayHelper;
use InvalidArgumentException;

class ConstantValuesHelper
{
    protected static $values = [];

    public static function getLabel($value)
    {
        $result = array_search($value, array_column(static::$values, "value"));
        if ($result === false) {
            throw new InvalidArgumentException('Value not found.');
        }
        return static::$values[$result]['label'];
    }

    public static function getHtml($value)
    {
        $result = array_search($value, array_column(static::$values, "value"));
        if ($result === false) {
            throw new InvalidArgumentException('Value not found.');
        }
        return static::$values[$result]['html'];
    }

    public static function getValues()
    {
        return array_column(static::$values, 'value');
    }

    public static function getLabels()
    {
        return array_column(static::$values, 'label');
    }

    public static function map()
    {
        $keys = array_column(static::$values, 'value');
        $labels = array_column(static::$values, 'label');

        return array_combine($keys, $labels);
    }
}
