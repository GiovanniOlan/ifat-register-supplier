<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cat_line".
 *
 * @property int $clin_id ID
 * @property string $clin_name Nombre
 * @property string $clin_code Código
 *
 * @property CatLineAssignment[] $catLineAssignments
 */
class CatLine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_line';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['clin_name', 'required'],
            ['clin_code', 'required'],
            [['clin_name'], 'string', 'max' => 50],
            [['clin_code'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clin_id' => Yii::t('app', 'ID'),
            'clin_name' => Yii::t('app', 'Nombre'),
            'clin_code' => Yii::t('app', 'Código'),
        ];
    }

    /**
     * Gets query for [[CatLineAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatLineAssignments()
    {
        return $this->hasMany(CatLineAssignment::class, ['clias_fkline' => 'clin_id']);
    }
}
