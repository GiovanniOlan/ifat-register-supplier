<?php

namespace app\models;

use app\utils\helpers\StatusHelper;
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
            ['sup_fkuser', 'integer'],
            ['sup_fkuser', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['sup_fkuser' => 'id']],

            ['sup_phone', 'required'],
            ['sup_phone', 'integer'],
            [
                'sup_phone', 'match', 'pattern' => '/^[0-9]{10}$/',
                'message' => 'El número telefónico debe contener 10 dígitos.'
            ],

            ['sup_rfc', 'string', 'max' => 50],
            ['sup_rfc', 'unique'],
            ['sup_rfc', 'required'],

            ['sup_curp', 'required'],
            ['sup_curp', 'string', 'max' => 50],

            ['sup_status', 'integer'],
            ['sup_status', 'in', 'range' => StatusHelper::getValues()],

            ['created_at', 'safe'],
            ['updated_at', 'safe'],
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
