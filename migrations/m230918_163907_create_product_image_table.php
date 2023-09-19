<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product_image}}`.
 */
class m230918_163907_create_product_image_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_image', [
            'proima_id' => $this->integer()->notNull()->comment('ID'),
            'proima_path' => $this->string(255)->notNull()->comment('Ruta'),
            'proima_fkproduct' => $this->integer()->notNull()->comment('Producto'),
            'proima_created_at' => $this->timestamp()->comment('Creado')->defaultValue(new \yii\db\Expression('CURRENT_TIMESTAMP')),
        ]);

        $this->addForeignKey('product_image_ibfk_1', 'product_image', 'proima_fkproduct', 'product', 'pro_id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'product_image_ibfk_1',
            'product_image'
        );

        $this->dropTable('product_image');
    }
}
