<?php

use yii\db\Migration;

/**
 * Handles the creation of table `infinitive`.
 */
class m181107_173405_create_infinitive_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('infinitive', [
            'english' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'russian' => $this->char(45)->append('CHARACTER SET utf8 COLLATE utf8_unicode_ci'),
            'PRIMARY KEY(english, russian)',
        ],'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('infinitive');
    }
}
