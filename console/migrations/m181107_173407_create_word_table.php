<?php

use yii\db\Migration;

/**
 * Handles the creation of table `word`.
 */
class m181107_173407_create_word_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('word', [
            'english' => $this->char(45),
            'russian' => $this->char(45),
            'infinitive_english' => $this->char(45),
            'infinitive_russian' => $this->char(45),
            'PRIMARY KEY(english, russian)'
        ]);

        $this->addForeignKey(
            'fk-word-infinitive',
            'word',
            ['infinitive_english', 'infinitive_russian'],
            'infinitive',
            ['english', 'russian'],
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-word-infinitive',
            'word'
        );
        $this->dropTable('word');
    }
}
