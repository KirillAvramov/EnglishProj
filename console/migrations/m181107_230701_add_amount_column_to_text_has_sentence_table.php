<?php

use yii\db\Migration;

/**
 * Handles adding amount to table `text_has_sentence`.
 */
class m181107_230701_add_amount_column_to_text_has_sentence_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('text_has_sentence', 'amount', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('text_has_sentence', 'amount');
    }
}
