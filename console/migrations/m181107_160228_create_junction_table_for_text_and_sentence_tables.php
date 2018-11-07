<?php

use yii\db\Migration;

/**
 * Handles the creation of table `text_has_sentence`.
 * Has foreign keys to the tables:
 *
 * - `text`
 * - `sentence`
 */
class m181107_160228_create_junction_table_for_text_and_sentence_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('text_has_sentence', [
            'text_user_id' => $this->integer(),
            'sentence_id' => $this->integer(),
            'PRIMARY KEY(text_user_id, sentence_id)',
        ]);

        // creates index for column `text_user_id`
        $this->createIndex(
            'idx-text_has_sentence-text_user_id',
            'text_has_sentence',
            'text_user_id'
        );

        // add foreign key for table `text`
        $this->addForeignKey(
            'fk-text_has_sentence-text_user_id',
            'text_has_sentence',
            'text_user_id',
            'text',
            'user_id',
            'CASCADE'
        );

        // creates index for column `sentence_id`
        $this->createIndex(
            'idx-text_has_sentence-sentence_id',
            'text_has_sentence',
            'sentence_id'
        );

        // add foreign key for table `sentence`
        $this->addForeignKey(
            'fk-text_has_sentence-sentence_id',
            'text_has_sentence',
            'sentence_id',
            'sentence',
            'id',
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
            'fk-text_has_sentence-text_user_id',
            'text_has_sentence'
        );

        // drops index for column `text_user_id`
        $this->dropIndex(
            'idx-text_has_sentence-text_user_id',
            'text_has_sentence'
        );

        // drops foreign key for table `sentence`
        $this->dropForeignKey(
            'fk-text_has_sentence-sentence_id',
            'text_has_sentence'
        );

        // drops index for column `sentence_id`
        $this->dropIndex(
            'idx-text_has_sentence-sentence_id',
            'text_has_sentence'
        );

        $this->dropTable('text_has_sentence');
    }
}
