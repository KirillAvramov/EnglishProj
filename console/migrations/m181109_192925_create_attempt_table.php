<?php

use yii\db\Migration;

/**
 * Handles the creation of table `attempt`.
 */
class m181109_192925_create_attempt_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attempt', [
            'user_id' => $this->integer(),
            'word_english' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'word_russian' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'time' => $this->timestamp(),
            'is_en_to_ru' => $this->boolean(),
            'success' => $this->boolean(),
            'PRIMARY KEY(user_id, word_english, word_russian)'
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        $this->addForeignKey(
            'fk-attempt-user_id',
            'attempt',
            'user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-attempt-word',
            'attempt',
            ['word_english', 'word_russian'],
            'word',
            ['english', 'russian']
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-attempt-user_id',
            'attempt'
        );
        $this->dropForeignKey(
            'fk-attempt-word',
            'attempt'
        );
        $this->dropTable('attempt');
    }
}
