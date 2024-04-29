<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m230918_163846_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product', [
            'pro_id' => $this->primaryKey()->comment('ID'),
            'pro_name' => $this->string(255)->notNull()->comment('Nombre'),
            'pro_description' => $this->string(255)->notNull()->comment('Descripción'),
            'pro_is_craft' => $this->tinyInteger(2)->notNull()->comment('Es Manualidad'),
            'pro_points' => $this->integer()->notNull()->comment('Calificación Matriz'),
            'pro_fkuser' => $this->integer()->notNull()->comment('Usuario'),
            'pro_fkmdam' => $this->integer()->null()->defaultValue(null),
        ]);

        $this->addForeignKey('product_ibfk_1', 'product', 'pro_fkuser', 'user', 'id', 'CASCADE');
        $this->addForeignKey('product_ibfk_2', 'product', 'pro_fkmdam', 'matriz_dam', 'mdam_id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'product_ibfk_1',
            'product'
        );
        $this->dropForeignKey(
            'product_ibfk_2',
            'product'
        );

        $this->dropTable('product');
    }
}
