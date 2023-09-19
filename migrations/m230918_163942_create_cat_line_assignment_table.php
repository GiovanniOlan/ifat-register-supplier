<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cat_line_assignment}}`.
 */
class m230918_163942_create_cat_line_assignment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cat_line_assignment', [
            'clias_id' => $this->primaryKey()->comment('ID'),
            'clias_fkproduct' => $this->integer()->notNull()->comment('Producto'),
            'clias_fkline' => $this->integer()->notNull()->comment('Línea'),
        ]);
        $this->addForeignKey('cat_line_assignment_ibfk_1', 'cat_line_assignment', 'clias_fkproduct', 'product', 'pro_id', 'CASCADE');
        $this->addForeignKey('cat_line_assignment_ibfk_2', 'cat_line_assignment', 'clias_fkline', 'cat_line', 'clin_id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'cat_line_assignment_ibfk_1',
            'cat_line_assignment'
        );

        $this->dropForeignKey(
            'cat_line_assignment_ibfk_2',
            'cat_line_assignment'
        );
        $this->dropTable('cat_line_assignment');
    }
}
