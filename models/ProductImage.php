<?php

namespace app\models;

use Yii;
use app\models\Product;

/**
 * This is the model class for table "product_image".
 *
 * @property int $proima_id ID
 * @property string $proima_path Ruta
 * @property int $proima_fkproduct Producto
 * @property string $proima_created_at Creado
 *
 * @property Product $proimaFkproduct
 */
class ProductImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['proima_id', 'required'],
            ['proima_path', 'required'],
            ['proima_fkproduct', 'required'],


            ['proima_id', 'integer'],
            ['proima_fkproduct', 'integer'],

            ['proima_created_at', 'safe'],
            ['proima_path', 'string', 'max' => 255],
            ['proima_fkproduct', 'exist', 'skipOnError' => true, 'targetClass' => Product::class, 'targetAttribute' => ['proima_fkproduct' => 'pro_id']],



        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'proima_id' => Yii::t('app', 'ID'),
            'proima_path' => Yii::t('app', 'Ruta'),
            'proima_fkproduct' => Yii::t('app', 'Producto'),
            'proima_created_at' => Yii::t('app', 'Creado'),
        ];
    }

    /**
     * Gets query for [[ProimaFkproduct]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProimaFkproduct()
    {
        return $this->hasOne(Product::class, ['pro_id' => 'proima_fkproduct']);
    }
}
