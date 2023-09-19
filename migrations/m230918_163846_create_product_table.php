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
            'pro_fkuser' => $this->integer()->notNull()->comment('Usuario'),
        ]);

        $this->addForeignKey('product_ibfk_1', 'product', 'pro_fkuser', 'user', 'id', 'CASCADE');
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

        $this->dropTable('product');
    }
}
