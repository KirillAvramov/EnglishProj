<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "text_has_word".
 *
 * @property int $text_id
 * @property string $word_english
 * @property string $word_russian
 * @property int $amount
 *
 * @property Text $text
 * @property Word $wordEnglish
 */
class TextHasWord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_has_word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_id', 'word_english', 'word_russian'], 'required'],
            [['text_id', 'amount'], 'integer'],
            [['word_english', 'word_russian'], 'string', 'max' => 45],
            [['text_id', 'word_english', 'word_russian'], 'unique', 'targetAttribute' => ['text_id', 'word_english', 'word_russian']],
            [['text_id'], 'exist', 'skipOnError' => true, 'targetClass' => Text::className(), 'targetAttribute' => ['text_id' => 'id']],
            [['word_english', 'word_russian'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_english' => 'english', 'word_russian' => 'russian']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text_id' => 'Text ID',
            'word_english' => 'Word English',
            'word_russian' => 'Word Russian',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getText()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordEnglish()
    {
        return $this->hasOne(Word::className(), ['english' => 'word_english', 'russian' => 'word_russian']);
    }
}
