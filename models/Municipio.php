<?php

namespace app\models;

use Yii;
use app\models\Estado;

/**
 * This is the model class for table "municipio".
 *
 * @property int $id
 * @property string|null $nombre
 * @property int $estado
 * @property int $cp_min
 * @property int $cp_max
 * @property string|null $huso_horario
 *
 * @property Colonia[] $colonias
 * @property Estado $estado0
 */
class Municipio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'municipio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'required'],
            ['estado', 'required'],
            ['cp_min', 'required'],
            ['cp_max', 'required'],

            ['id', 'integer'],
            ['estado', 'integer'],
            ['cp_min', 'integer'],
            ['cp_max', 'integer'],

            ['huso_horario', 'string'],
            ['nombre', 'string', 'max' => 60],
            ['id', 'unique'],
            ['estado', 'exist', 'skipOnError' => true, 'targetClass' => Estado::class, 'targetAttribute' => ['estado' => 'clave']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'estado' => Yii::t('app', 'Estado'),
            'cp_min' => Yii::t('app', 'Cp Min'),
            'cp_max' => Yii::t('app', 'Cp Max'),
            'huso_horario' => Yii::t('app', 'Huso Horario'),
        ];
    }

    /**
     * Gets query for [[Colonias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColonias()
    {
        return $this->hasMany(Colonia::class, ['municipio' => 'id']);
    }

    /**
     * Gets query for [[Estado0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Estado::class, ['clave' => 'estado']);
    }
}
