<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $sup_fkuser Usuario
 * @property string $sup_phone Teléfono
 * @property string $sup_curp CURP
 * @property string $sup_rfc RFC
 * @property int|null $sup_status Estado
 * @property string $created_at Creado
 * @property string $updated_at Actualizado
 *
 * @property User $supFkuser
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['sup_fkuser', 'required'],
            ['sup_phone', 'required'],
            ['sup_curp', 'required'],
            ['sup_rfc', 'required'],

            ['sup_fkuser', 'integer'],
            ['sup_status', 'integer'],

            ['created_at', 'safe'],
            ['updated_at', 'safe'],

            ['sup_phone', 'string', 'max' => 30],
            ['sup_curp', 'string', 'max' => 50],
            ['sup_rfc', 'string', 'max' => 50],
            ['sup_fkuser', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sup_fkuser' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sup_fkuser' => Yii::t('app', 'Usuario'),
            'sup_phone' => Yii::t('app', 'Teléfono'),
            'sup_curp' => Yii::t('app', 'CURP'),
            'sup_rfc' => Yii::t('app', 'RFC'),
            'sup_status' => Yii::t('app', 'Estado'),
            'created_at' => Yii::t('app', 'Creado'),
            'updated_at' => Yii::t('app', 'Actualizado'),
        ];
    }

    /**
     * Gets query for [[SupFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupFkuser()
    {
        return $this->hasOne(User::class, ['id' => 'sup_fkuser']);
    }
}
