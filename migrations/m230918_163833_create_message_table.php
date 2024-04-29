<?php

use yii\db\Migration;

/**
 * m240422_063511__message_table
 */
class m230918_163833_create_message_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('message', [
            'mess_id' => $this->primaryKey(),
            'mess_reason' => $this->string(250)->comment('Motivo'),
            'mess_meeting_day' => $this->date()->comment('Día de la reunión'),
            'mess_meeting_time' => $this->time()->comment('Hora de la reunión'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('message');
    }
}
