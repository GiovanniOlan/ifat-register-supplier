<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%supplier}}`.
 */
class m230918_163834_create_supplier_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('supplier', [
            'sup_fkuser' => $this->primaryKey()->comment('Usuario'),
            'sup_phone' => $this->string(30)->notNull()->comment('Teléfono'),
            'sup_curp' => $this->string(50)->notNull()->comment('CURP'),
            'sup_rfc' => $this->string(50)->notNull()->comment('RFC'),
            'sup_status' => $this->tinyInteger()->defaultValue(1)->comment('Estado'),
            'created_at' => $this->timestamp()->comment('Creado'),
            'updated_at' => $this->timestamp()->comment('Actualizado'),
            'sup_finished' => $this->tinyInteger(2)->notNull()->defaultValue(1),
            'sup_fkmessage' => $this->integer(11)->null()->defaultValue(null),
        ]);

        $this->addForeignKey('supplier_ibfk_1', 'supplier', 'sup_fkuser', 'user', 'id', 'CASCADE');
        $this->addForeignKey('supplier_ibfk_2', 'supplier', 'sup_fkmessage', 'message', 'mess_id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'supplier_ibfk_1',
            'supplier'
        );
        $this->dropForeignKey(
            'supplier_ibfk_2',
            'supplier'
        );

        $this->dropTable('supplier');
    }
}
