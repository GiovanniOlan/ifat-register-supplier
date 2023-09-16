<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "address".
 *
 * @property int $add_fkuser
 * @property int $add_fkcolonia
 * @property string $add_street
 * @property string $add_exterior
 * @property string|null $add_interior
 * @property string $add_note
 *
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
            [['add_fkuser', 'add_fkcolonia', 'add_street', 'add_exterior', 'add_note'], 'required'],
            [['add_fkuser', 'add_fkcolonia'], 'integer'],
            [['add_note'], 'string'],
            [['add_street'], 'string', 'max' => 255],
            [['add_exterior', 'add_interior'], 'string', 'max' => 50],
            [['add_fkuser'], 'unique'],
            [['add_fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => UserTable::class, 'targetAttribute' => ['add_fkuser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'add_fkuser' => Yii::t('app', 'Add Fkuser'),
            'add_fkcolonia' => Yii::t('app', 'Add Fkcolonia'),
            'add_street' => Yii::t('app', 'Add Street'),
            'add_exterior' => Yii::t('app', 'Add Exterior'),
            'add_interior' => Yii::t('app', 'Add Interior'),
            'add_note' => Yii::t('app', 'Add Note'),
        ];
    }

    /**
     * Gets query for [[AddFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAddFkuser()
    {
        return $this->hasOne(UserTable::class, ['id' => 'add_fkuser']);
    }
}
