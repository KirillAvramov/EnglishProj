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
            'english' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'russian' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'infinitive_english' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'infinitive_russian' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'PRIMARY KEY(english, russian)'
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

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
