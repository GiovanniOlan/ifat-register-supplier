<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $per_fkuser
 * @property string $per_name
 * @property string|null $per_lastname_paternal
 * @property string|null $per_lastname_maternal
 * @property int $per_gender
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
            [['per_fkuser', 'per_name', 'per_gender'], 'required'],
            [['per_fkuser', 'per_gender'], 'integer'],
            [['per_name', 'per_lastname_paternal', 'per_lastname_maternal'], 'string', 'max' => 40],
            [['per_fkuser'], 'unique'],
            [['per_fkuser'], 'exist', 'skipOnError' => true, 'targetClass' => UserTable::class, 'targetAttribute' => ['per_fkuser' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'per_fkuser' => Yii::t('app', 'Per Fkuser'),
            'per_name' => Yii::t('app', 'Per Name'),
            'per_lastname_paternal' => Yii::t('app', 'Per Lastname Paternal'),
            'per_lastname_maternal' => Yii::t('app', 'Per Lastname Maternal'),
            'per_gender' => Yii::t('app', 'Per Gender'),
        ];
    }

    /**
     * Gets query for [[PerFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerFkuser()
    {
        return $this->hasOne(UserTable::class, ['id' => 'per_fkuser']);
    }
}
