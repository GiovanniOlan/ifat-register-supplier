<?php

use yii\db\Migration;

/**
 * Class  m230918_163845_matriz_dam
 */
class m230918_163844_create_matriz_dam_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('matriz_dam', [
            'mdam_id' => $this->primaryKey()->comment('ID'),
            'mdam_question1' => $this->string(40)->comment('Origen de la Materia Prima'),
            'mdam_question2' => $this->string(40)->comment('Obtención de la Materia Prima'),
            'mdam_question3' => $this->string(40)->comment('Forma de elaboración de la pieza'),
            'mdam_question4' => $this->string(40)->comment('Herramientas'),
            'mdam_question5' => $this->string(40)->comment('Teñido/Pintado'),
            'mdam_question6' => $this->string(40)->comment('Tiempo de elaboración'),
            'mdam_question7' => $this->string(40)->comment('Diseño del producto'),
            'mdam_question8' => $this->string(40)->comment('Representatividad'),
            'mdam_question9' => $this->string(40)->comment('Uso del producto'),
            'mdam_question10' => $this->string(40)->comment('División del trabajo'),
            'mdam_question11' => $this->string(40)->comment('Transmisión del conocimiento'),
            'mdam_question12' => $this->string(40)->comment('Pertenece a un grupo étnico que elabora un producto tradicional'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('matriz_dam');
    }
}
