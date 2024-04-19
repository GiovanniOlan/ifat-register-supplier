<?php

namespace app\models;

use Yii;
use app\models\CatLine;
use app\models\Product;

/**
 * This is the model class for table "cat_line_assignment".
 *
 * @property int $clias_id ID
 * @property int $clias_fkproduct Producto
 * @property int $clias_fkline Línea
 *
 * @property CatLine $cliasFkline
 * @property Product $cliasFkproduct
 */
class CatLineAssignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cat_line_assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['clias_fkproduct', 'required'],
            ['clias_fkline', 'required'],
            ['clias_fkproduct', 'integer'],
            ['clias_fkline', 'integer'],
            ['clias_fkproduct', 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['clias_fkproduct' => 'pro_id']],
            ['clias_fkline', 'exist', 'skipOnError' => true, 'targetClass' => CatLine::class, 'targetAttribute' => ['clias_fkline' => 'clin_id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'clias_id' => Yii::t('app', 'ID'),
            'clias_fkproduct' => Yii::t('app', 'Producto'),
            'clias_fkline' => Yii::t('app', 'Línea'),
        ];
    }

    /**
     * Gets query for [[CliasFkline]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliasFkline()
    {
        return $this->hasOne(CatLine::class, ['clin_id' => 'clias_fkline']);
    }

    /**
     * Gets query for [[CliasFkproduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliasFkproduct()
    {
        return $this->hasOne(Product::class, ['pro_id' => 'clias_fkproduct']);
    }
}
