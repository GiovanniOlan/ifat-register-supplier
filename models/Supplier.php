<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $sup_fkuser
 * @property string $sup_phone
 * @property string $sup_curp
 * @property string $sup_rfc
 * @property int $sup_status
 * @property string|null $created_at
 * @property string|null $updated_at
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
            [['sup_fkuser', 'sup_phone', 'sup_curp', 'sup_rfc'], 'required'],
            [['sup_fkuser', 'sup_status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['sup_phone'], 'string', 'max' => 30],
            [['sup_curp', 'sup_rfc'], 'string', 'max' => 50],
            [['sup_fkuser'], 'unique'],
            [['sup_fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => UserTable::class, 'targetAttribute' => ['sup_fkuser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sup_fkuser' => Yii::t('app', 'Sup Fkuser'),
            'sup_phone' => Yii::t('app', 'Sup Phone'),
            'sup_curp' => Yii::t('app', 'Sup Curp'),
            'sup_rfc' => Yii::t('app', 'Sup Rfc'),
            'sup_status' => Yii::t('app', 'Sup Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[SupFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSupFkuser()
    {
        return $this->hasOne(UserTable::class, ['id' => 'sup_fkuser']);
    }
}
