<?php

use yii\db\Migration;

/**
 * Handles the creation of table `study`.
 */
class m181109_191943_create_study_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('study', [
            'user_id' => $this->integer(),
            'word_english' => $this->char(45),
            'word_russian' => $this->char(45),
            'status' => $this->integer(),
            'PRIMARY KEY(user_id, word_english, word_russian)'
        ]);

        $this->addForeignKey(
            'fk-study-user_id',
            'study',
            'user_id',
            'user',
            'id'
        );

        $this->addForeignKey(
            'fk-study-word',
            'study',
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
            'fk-study-user_id',
            'study'
        );
        $this->dropForeignKey(
            'fk-study-word',
            'study'
        );
        $this->dropTable('study');
    }
}
