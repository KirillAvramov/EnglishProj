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
            'user_id' => $this->integer(),
            'text' => $this->text()->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'md5' => $this->char(32),
        ], 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');

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
