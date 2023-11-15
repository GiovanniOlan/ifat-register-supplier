<?php

namespace app\models;

use Yii;
use app\models\Municipio;

/**
 * This is the model class for table "colonia".
 *
 * @property int $id
 * @property string $nombre
 * @property int $municipio
 * @property string $asentamiento
 * @property int $codigo_postal
 * @property float|null $latitud
 * @property float|null $longitud
 *
 * @property Address[] $addresses
 * @property Municipio $municipio0
 */
class Colonia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'colonia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['id', 'required'],
            ['nombre', 'required'],
            ['municipio', 'required'],
            ['asentamiento', 'required'],
            ['codigo_postal', 'required'],

            ['id', 'integer'],
            ['municipio', 'integer'],
            ['codigo_postal', 'integer'],

            ['latitud', 'number'],
            ['longitud', 'number'],

            ['nombre', 'string', 'max' => 60],
            ['asentamiento', 'string', 'max' => 40],
            ['id', 'unique'],
            ['municipio', 'exist', 'skipOnError' => true, 'targetClass' => Municipio::class, 'targetAttribute' => ['municipio' => 'id']],

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
            'municipio' => Yii::t('app', 'Municipio'),
            'asentamiento' => Yii::t('app', 'Asentamiento'),
            'codigo_postal' => Yii::t('app', 'Codigo Postal'),
            'latitud' => Yii::t('app', 'Latitud'),
            'longitud' => Yii::t('app', 'Longitud'),
        ];
    }

    /**
     * Gets query for [[Addresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddresses()
    {
        return $this->hasMany(Address::class, ['add_fkcolonia' => 'id']);
    }

    /**
     * Gets query for [[Municipio0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio0()
    {
        return $this->hasOne(Municipio::class, ['id' => 'municipio']);
    }
}
