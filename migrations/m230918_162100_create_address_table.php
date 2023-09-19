<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%address}}`.
 */
class m230918_162100_create_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('address', [
            'add_fkuser' => $this->integer()->notNull()->comment(('Usuario')),
            'add_fkcolonia' => $this->integer()->notNull()->comment('Colonia'),
            'add_street' => $this->string(255)->notNull()->comment('Calle'),
            'add_exterior' => $this->string(50)->notNull()->comment('Número Exterior'),
            'add_interior' => $this->string(50)->comment('Número Interior'),
            'add_note' => $this->text(255)->notNull()->comment('Notas'),
        ]);

        $this->addForeignKey('address_ibfk_1', 'address', 'add_fkuser', 'user', 'id', 'CASCADE');
        $this->addForeignKey('address_ibfk_2', 'address', 'add_fkcolonia', 'colonia', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'address_ibfk_2',
            'address'
        );

        $this->dropForeignKey(
            'address_ibfk_1',
            'address'
        );

        $this->dropTable('address');
    }
}
