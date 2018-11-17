<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sentence_has_word".
 *
 * @property int $sentence_id
 * @property string $word_english
 * @property string $word_russian
 *
 * @property Sentence $sentence
 * @property Word $wordEnglish
 */
class SentenceHasWord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sentence_has_word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sentence_id', 'word_english', 'word_russian'], 'required'],
            [['sentence_id'], 'integer'],
            [['word_english', 'word_russian'], 'string', 'max' => 45],
            [['sentence_id', 'word_english', 'word_russian'], 'unique', 'targetAttribute' => ['sentence_id', 'word_english', 'word_russian']],
            [['sentence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sentence::className(), 'targetAttribute' => ['sentence_id' => 'id']],
            [['word_english', 'word_russian'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_english' => 'english', 'word_russian' => 'russian']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'sentence_id' => 'Sentence ID',
            'word_english' => 'Word English',
            'word_russian' => 'Word Russian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentence()
    {
        return $this->hasOne(Sentence::className(), ['id' => 'sentence_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordEnglish()
    {
        return $this->hasOne(Word::className(), ['english' => 'word_english', 'russian' => 'word_russian']);
    }
}
