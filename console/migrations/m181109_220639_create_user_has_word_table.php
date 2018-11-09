<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_has_word`.
 */
class m181109_220639_create_user_has_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_has_word', [
            'user_id' => $this->integer(),
            'word_english' => $this->char(45),
            'word_russian' => $this->char(45),
            'amount' => $this->integer(),
            'PRIMARY KEY(user_id, word_english, word_russian)'
        ]);

        $this->addForeignKey(
            'fk-user_has_word-user_id',
            'user_has_word',
            'user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-user_has_word-word',
            'user_has_word',
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
            'fk-user_has_word-word',
            'user_has_word'
        );
        $this->dropForeignKey(
            'fk-user_has_word-user_id',
            'user_has_word'
        );
        $this->dropTable('user_has_word');
    }
}
