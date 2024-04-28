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
    public $question1;
    public $question2;
    public $question3;
    public $question4;
    public $question5;
    public $question6;
    public $question7;
    public $question8;
    public $question9;
    public $question10;
    public $question11;
    public $question12;

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
            // Agrega etiquetas para las preguntas del cuestionario
            'question1' => Yii::t('app', 'Origen de la Materia Prima'),
            'question2' => Yii::t('app', 'Obtención de la Materia Prima'),
            'question3' => Yii::t('app', 'Forma de elaboración de la pieza'),
            'question4' => Yii::t('app', 'Herramientas'),
            'question5' => Yii::t('app', 'Teñido/Pintado'),
            'question6' => Yii::t('app', 'Tiempo de elaboración'),
            'question7' => Yii::t('app', 'Diseño del producto'),
            'question8' => Yii::t('app', 'Representatividad'),
            'question9' => Yii::t('app', 'Uso del producto'),
            'question10' => Yii::t('app', 'División del trabajo'),
            'question11' => Yii::t('app', 'Transmisión del conocimiento'),
            'question12' => Yii::t('app', 'Pertenece a un grupo étnico'),
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
     * Gets query for [[ProFkuser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMatrizDam() //ProFkmdam
    {
        return $this->hasOne(MatrizDam::class, ['mdam_id' => 'pro_fkmdam']);
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
