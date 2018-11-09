<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m181109_194819_create_settings_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('settings', [
            'user_id' => $this->primaryKey(),
            'attempts_to_studied' => $this->integer()->defaultValue(5)
        ]);

        $this->addForeignKey(
            'fk-settings-user_id',
            'settings',
            'user_id',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-settings-user_id',
            'settings'
        );
        $this->dropTable('settings');
    }
}
