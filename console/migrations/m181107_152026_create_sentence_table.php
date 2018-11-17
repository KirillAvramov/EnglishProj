<?php

use yii\db\Migration;

/**
 * Handles the creation of table `sentence`.
 */
class m181107_152026_create_sentence_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('sentence', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('sentence');
    }
}
