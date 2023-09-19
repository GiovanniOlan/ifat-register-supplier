<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Colonia;

/**
 * This is the model class for table "address".
 *
 * @property int $add_fkuser Usuario
 * @property int $add_fkcolonia Colonia
 * @property string $add_street Calle
 * @property string $add_exterior Número Exterior
 * @property string|null $add_interior Número Interior
 * @property string $add_note Notas
 *
 * @property Colonia $addFkcolonia
 * @property User $addFkuser
 */
class Address extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'address';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['add_fkuser', 'required'],
            ['add_fkcolonia', 'required'],
            ['add_street', 'required'],
            ['add_exterior', 'required'],
            ['add_note', 'required'],

            ['add_fkuser', 'integer'],
            ['add_fkcolonia', 'integer'],

            ['add_note', 'string'],
            ['add_street', 'string', 'max' => 255],
            ['add_exterior', 'string', 'max' => 50],
            ['add_interior', 'string', 'max' => 50],

            ['add_fkuser', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['add_fkuser' => 'id']],
            ['add_fkcolonia', 'exist', 'skipOnError' => true, 'targetClass' => Colonia::class, 'targetAttribute' => ['add_fkcolonia' => 'id']],



        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'add_fkuser' => Yii::t('app', 'Usuario'),
            'add_fkcolonia' => Yii::t('app', 'Colonia'),
            'add_street' => Yii::t('app', 'Calle'),
            'add_exterior' => Yii::t('app', 'Número Exterior'),
            'add_interior' => Yii::t('app', 'Número Interior'),
            'add_note' => Yii::t('app', 'Notas'),
        ];
    }

    /**
     * Gets query for [[AddFkcolonia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddFkcolonia()
    {
        return $this->hasOne(Colonia::class, ['id' => 'add_fkcolonia']);
    }

    /**
     * Gets query for [[AddFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddFkuser()
    {
        return $this->hasOne(User::class, ['id' => 'add_fkuser']);
    }
}
