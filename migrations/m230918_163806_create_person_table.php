<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%person}}`.
 */
class m230918_163806_create_person_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('person', [
            'per_fkuser' => $this->integer()->notNull()->comment('Usuario'),
            'per_name' => $this->string(40)->notNull()->comment('Nombre'),
            'per_lastname_paternal' => $this->string(40)->comment('Apellido Paterno'),
            'per_lastname_maternal' => $this->string(40)->comment('Apellido Materno'),
            'per_gender' => $this->tinyInteger(2)->notNull()->comment('Genero'),
        ]);
        $this->addForeignKey('person_ibfk_1', 'person', 'per_fkuser', 'user', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'person_ibfk_1',
            'person'
        );

        $this->dropTable('person');
    }
}
