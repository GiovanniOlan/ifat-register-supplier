<?php

namespace app\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "product".
 *
 * @property int $pro_id ID
 * @property string $pro_name Nombre
 * @property string $pro_description Descripción
 * @property int $pro_is_craft Es Manualidad
 * @property int $pro_fkuser Usuario
 *
 * @property CatLineAssignment[] $catLineAssignments
 * @property User $proFkuser
 * @property ProductImage[] $productImages
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['pro_name', 'required'],
            ['pro_description', 'required'],
            ['pro_is_craft', 'required'],
            ['pro_fkuser', 'required'],

            ['pro_is_craft', 'integer'],
            ['pro_fkuser', 'integer'],

            ['pro_name', 'string', 'max' => 255],
            ['pro_description', 'string', 'max' => 255],
            ['pro_fkuser', 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['pro_fkuser' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pro_id' => Yii::t('app', 'ID'),
            'pro_name' => Yii::t('app', 'Nombre'),
            'pro_description' => Yii::t('app', 'Descripción'),
            'pro_is_craft' => Yii::t('app', 'Es Manualidad'),
            'pro_fkuser' => Yii::t('app', 'Usuario'),
        ];
    }

    /**
     * Gets query for [[CatLineAssignments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCatLineAssignments()
    {
        return $this->hasMany(CatLineAssignment::class, ['clias_fkproduct' => 'pro_id']);
    }

    /**
     * Gets query for [[ProFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProFkuser()
    {
        return $this->hasOne(User::class, ['id' => 'pro_fkuser']);
    }

    /**
     * Gets query for [[ProductImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductImages()
    {
        return $this->hasMany(ProductImage::class, ['proima_fkproduct' => 'pro_id']);
    }
}
