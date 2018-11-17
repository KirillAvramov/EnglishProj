<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sentence_has_word`.
 * Has foreign keys to the tables:
 *
 * - `sentence`
 * - `word`
 */
class m181107_230240_create_junction_table_for_sentence_and_word_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $this->createTable('sentence_has_word', [
            'sentence_id' => $this->integer(),
            'word_english' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'word_russian' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'PRIMARY KEY(sentence_id, word_english, word_russian)',
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

        // creates index for column `sentence_id`
        $this->createIndex(
            'idx-sentence_has_word-sentence_id',
            'sentence_has_word',
            'sentence_id'
        );

        // add foreign key for table `sentence`
        $this->addForeignKey(
            'fk-sentence_has_word-sentence_id',
            'sentence_has_word',
            'sentence_id',
            'sentence',
            'id',
            'CASCADE'
        );

        // creates index for columns `word_english`, 'word_russian
        $this->createIndex(
            'idx-sentence_has_word-word',
            'sentence_has_word',
            ['word_english', 'word_russian']
        );

        // add foreign key for table `word`
        $this->addForeignKey(
            'fk-sentence_has_word-word',
            'sentence_has_word',
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
        // drops foreign key for table `sentence`
        $this->dropForeignKey(
            'fk-sentence_has_word-sentence_id',
            'sentence_has_word'
        );

        // drops index for column `sentence_id`
        $this->dropIndex(
            'idx-sentence_has_word-sentence_id',
            'sentence_has_word'
        );

        // drops foreign key for table `word`
        $this->dropForeignKey(
            'fk-sentence_has_word-word',
            'sentence_has_word'
        );

        // drops index for columns `word_english`, 'word_russian'
        $this->dropIndex(
            'idx-sentence_has_word-word',
            'sentence_has_word'
        );

        $this->dropTable('sentence_has_word');
    }
}
