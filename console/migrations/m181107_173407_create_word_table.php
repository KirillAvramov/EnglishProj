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
            'id' => $this->primaryKey(),
            'english' => $this->char(45),
            'russian' => $this->char(45),
            'infinitive_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-word-infinitive_id',
            'word',
            'infinitive_id',
            'infinitive',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-word-infinitive_id',
            'word'
        );
        $this->dropTable('word');
    }
}
