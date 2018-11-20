<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "word".
 *
 * @property string $english
 * @property string $russian
 * @property string $infinitive_english
 * @property string $infinitive_russian
 *
 * @property Attempt[] $attempts
 * @property User[] $users
 * @property SentenceHasWord[] $sentenceHasWords
 * @property Sentence[] $sentences
 * @property Study[] $studies
 * @property User[] $users0
 * @property TextHasWord[] $textHasWords
 * @property Text[] $texts
 * @property UserHasWord[] $userHasWords
 * @property User[] $users1
 * @property Infinitive $infinitiveEnglish
 */
class Word extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['english', 'russian'], 'required'],
            [['english', 'russian', 'infinitive_english', 'infinitive_russian'], 'string', 'max' => 45],
            [['english', 'russian'], 'unique', 'targetAttribute' => ['english', 'russian']],
            [['infinitive_english', 'infinitive_russian'], 'exist', 'skipOnError' => true, 'targetClass' => Infinitive::className(), 'targetAttribute' => ['infinitive_english' => 'english', 'infinitive_russian' => 'russian']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'english' => 'English',
            'russian' => 'Russian',
            'infinitive_english' => 'Infinitive English',
            'infinitive_russian' => 'Infinitive Russian',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttempts()
    {
        return $this->hasMany(Attempt::className(), ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('attempt', ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentenceHasWords()
    {
        return $this->hasMany(SentenceHasWord::className(), ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentences()
    {
        return $this->hasMany(Sentence::className(), ['id' => 'sentence_id'])->viaTable('sentence_has_word', ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudies()
    {
        return $this->hasMany(Study::className(), ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('study', ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTextHasWords()
    {
        return $this->hasMany(TextHasWord::className(), ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTexts()
    {
        return $this->hasMany(Text::className(), ['id' => 'text_id'])->viaTable('text_has_word', ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasWords()
    {
        return $this->hasMany(UserHasWord::className(), ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers1()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('user_has_word', ['word_english' => 'english', 'word_russian' => 'russian']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfinitiveEnglish()
    {
        return $this->hasOne(Infinitive::className(), ['english' => 'infinitive_english', 'russian' => 'infinitive_russian']);
    }
}
