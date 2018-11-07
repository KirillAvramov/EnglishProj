<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m181107_110350_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'user_id' => $this->primaryKey(),
            'username' => $this->char(42),
        ]);

        $this->addForeignKey(
            'fk-profile-user_id',
            'profile',
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
        'fk-profile-user_id',
        'profile'
        );
        $this->dropTable('profile');

    }
}
