<?php

use yii\db\Migration;

/**
 * Handles the creation of table `text`.
 */
class m181107_124057_create_text_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('text', [
            'user_id' => $this->primaryKey(),
            'text' => $this->text(),
            'file_path' => $this->char(100),
            'md5' => $this->char(32),
        ]);

        $this->addForeignKey(
            'fk-text-user_id',
            'text',
            'user_id',
            'user',
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
            'fk-text-user_id',
            'text'
        );
        $this->dropTable('text');

    }
}
