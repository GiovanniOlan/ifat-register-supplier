<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "person".
 *
 * @property int $per_fkuser Usuario
 * @property string $per_name Nombre
 * @property string|null $per_lastname_paternal Apellido Paterno
 * @property string|null $per_lastname_maternal Apellido Materno
 * @property int $per_gender Genero
 *
 * @property User $perFkuser
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['per_fkuser', 'required'],
            ['per_name', 'required'],
            ['per_gender', 'required'],

            ['per_fkuser', 'integer'],
            ['per_gender', 'integer'],

            ['per_name', 'string', 'max' => 40],
            ['per_lastname_paternal', 'string', 'max' => 40],
            ['per_lastname_maternal', 'string', 'max' => 40],
            ['per_fkuser', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['per_fkuser' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'per_fkuser' => Yii::t('app', 'Usuario'),
            'per_name' => Yii::t('app', 'Nombre'),
            'per_lastname_paternal' => Yii::t('app', 'Apellido Paterno'),
            'per_lastname_maternal' => Yii::t('app', 'Apellido Materno'),
            'per_gender' => Yii::t('app', 'Genero'),
        ];
    }

    /**
     * Gets query for [[PerFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerFkuser()
    {
        return $this->hasOne(User::class, ['id' => 'per_fkuser']);
    }
}
