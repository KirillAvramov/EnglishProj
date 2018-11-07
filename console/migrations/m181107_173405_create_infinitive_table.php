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
            'id' => $this->primaryKey(),
            'english' => $this->char(45),
            'russian' => $this->char(45),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('infinitive');
    }
}
