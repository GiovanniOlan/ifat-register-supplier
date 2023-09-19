<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estado".
 *
 * @property int $clave
 * @property string $nombre
 * @property string $abreviacion
 * @property int $cp_min
 * @property int $cp_max
 *
 * @property Municipio[] $municipios
 */
class Estado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['clave', 'required'],
            ['nombre', 'required'],
            ['abreviacion', 'required'],
            ['cp_min', 'required'],
            ['cp_max', 'required'],

            ['clave', 'integer'],
            ['cp_min', 'integer'],
            ['cp_max', 'integer'],

            ['nombre', 'string', 'max' => 33],
            ['abreviacion', 'string', 'max' => 4],
            ['clave', 'unique'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clave' => Yii::t('app', 'Clave'),
            'nombre' => Yii::t('app', 'Nombre'),
            'abreviacion' => Yii::t('app', 'Abreviacion'),
            'cp_min' => Yii::t('app', 'Cp Min'),
            'cp_max' => Yii::t('app', 'Cp Max'),
        ];
    }

    /**
     * Gets query for [[Municipios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipios()
    {
        return $this->hasMany(Municipio::class, ['estado' => 'clave']);
    }
}
