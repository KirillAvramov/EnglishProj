<?php

use yii\db\Migration;

/**
 * Handles the creation of table `text_has_word`.
 * Has foreign keys to the tables:
 *
 * - `text`
 * - `word`
 */
class m181109_165504_create_junction_table_for_text_and_word_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('text_has_word', [
            'text_id' => $this->integer(),
            'word_english' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'word_russian' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'amount' => $this->integer(),
            'PRIMARY KEY(text_id, word_english, word_russian)',
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        // creates index for column `text_id`
        $this->createIndex(
            'idx-text_has_word-text_id',
            'text_has_word',
            'text_id'
        );

        // add foreign key for table `text`
        $this->addForeignKey(
            'fk-text_has_word-text_id',
            'text_has_word',
            'text_id',
            'text',
            'user_id',
            'CASCADE'
        );

        // creates index for columns `word_english`, 'word_russian
        $this->createIndex(
            'idx-text_has_word-word',
            'text_has_word',
            ['word_english', 'word_russian']
        );

        // add foreign key for table `word`
        $this->addForeignKey(
            'fk-text_has_word-word',
            'text_has_word',
            ['word_english', 'word_russian'],
            'word',
            ['english', 'russian'],
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `text`
        $this->dropForeignKey(
            'fk-text_has_word-text_id',
            'text_has_word'
        );

        // drops index for column `text_id`
        $this->dropIndex(
            'idx-text_has_word-text_id',
            'text_has_word'
        );

        // drops foreign key for table `word`
        $this->dropForeignKey(
            'fk-text_has_word-word',
            'text_has_word'
        );

        // drops index for columns `word_english`, 'word_russian'
        $this->dropIndex(
            'idx-text_has_word-word',
            'text_has_word'
        );

        $this->dropTable('text_has_word');
    }
}
