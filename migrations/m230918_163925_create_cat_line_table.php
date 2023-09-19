<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cat_line}}`.
 */
class m230918_163925_create_cat_line_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('cat_line', [
            'clin_id' => $this->primaryKey()->comment('ID'),
            'clin_name' => $this->string(50)->notNull()->comment('Nombre'),
            'clin_code' => $this->string(40)->notNull()->comment('Código'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('cat_line');
    }
}
