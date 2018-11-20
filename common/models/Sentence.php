<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sentence".
 *
 * @property int $id
 * @property string $content
 *
 * @property SentenceHasWord[] $sentenceHasWords
 * @property Word[] $wordEnglishes
 * @property TextHasSentence[] $textHasSentences
 * @property Text[] $texts
 */
class Sentence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sentence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentenceHasWords()
    {
        return $this->hasMany(SentenceHasWord::className(), ['sentence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordEnglishes()
    {
        return $this->hasMany(Word::className(), ['english' => 'word_english', 'russian' => 'word_russian'])->viaTable('sentence_has_word', ['sentence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTextHasSentences()
    {
        return $this->hasMany(TextHasSentence::className(), ['sentence_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTexts()
    {
        return $this->hasMany(Text::className(), ['id' => 'text_id'])->viaTable('text_has_sentence', ['sentence_id' => 'id']);
    }
}
