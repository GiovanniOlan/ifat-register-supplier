<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "matriz_dam".
 *
 * @property int $mdam_id ID
 * @property string|null $mdam_question1 Origen de la Materia Prima
 * @property string|null $mdam_question2 Obtención de la Materia Prima
 * @property string|null $mdam_question3 Forma de elaboración de la pieza
 * @property string|null $mdam_question4 Herramientas
 * @property string|null $mdam_question5 Teñido/Pintado
 * @property string|null $mdam_question6 Tiempo de elaboración
 * @property string|null $mdam_question7 Diseño del producto
 * @property string|null $mdam_question8 Representatividad
 * @property string|null $mdam_question9 Uso del producto
 * @property string|null $mdam_question10 División del trabajo
 * @property string|null $mdam_question11 Transmisión del conocimiento
 * @property string|null $mdam_question12 Pertenece a un grupo étnico que elabora un producto tradicional
 *
 * @property Product[] $products
 */
class MatrizDam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'matriz_dam';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mdam_question1', 'mdam_question2', 'mdam_question3', 'mdam_question4', 'mdam_question5', 'mdam_question6', 'mdam_question7', 'mdam_question8', 'mdam_question9', 'mdam_question10', 'mdam_question11', 'mdam_question12'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'mdam_id' => 'ID',
            'mdam_question1' => 'Origen de la Materia Prima',
            'mdam_question2' => 'Obtención de la Materia Prima',
            'mdam_question3' => 'Forma de elaboración de la pieza',
            'mdam_question4' => 'Herramientas',
            'mdam_question5' => 'Teñido/Pintado',
            'mdam_question6' => 'Tiempo de elaboración',
            'mdam_question7' => 'Diseño del producto',
            'mdam_question8' => 'Representatividad',
            'mdam_question9' => 'Uso del producto',
            'mdam_question10' => 'División del trabajo',
            'mdam_question11' => 'Transmisión del conocimiento',
            'mdam_question12' => 'Pertenece a un grupo étnico que elabora un producto tradicional',
        ];
    }

    /**
     * Gets query for [[Products]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::class, ['pro_fkmdam' => 'mdam_id']);
    }
}
