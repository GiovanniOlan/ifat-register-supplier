<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property int $mess_id
 * @property string|null $mess_reason
 * @property string|null $mess_meeting_day
 * @property string|null $mess_meeting_time
 *
 * @property Supplier[] $suppliers
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mess_meeting_day', 'mess_meeting_time'], 'safe'],
            [['mess_reason'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mess_id' => 'Mess ID',
            'mess_reason' => 'Motivo del Rechazo',
            'mess_meeting_day' => 'Dia de la cita',
            'mess_meeting_time' => 'Hora',
        ];
    }

    /**
     * Gets query for [[Suppliers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuppliers()
    {
        return $this->hasMany(Supplier::class, ['sup_fkmessage' => 'mess_id']);
    }
}
