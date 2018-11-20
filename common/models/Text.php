<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "text".
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property string $md5
 *
 * @property User $user
 * @property TextHasSentence[] $textHasSentences
 * @property Sentence[] $sentences
 * @property TextHasWord[] $textHasWords
 * @property Word[] $wordEnglishes
 */
class Text extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['text'], 'string'],
            [['md5'], 'string', 'max' => 32],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'text' => 'Text',
            'md5' => 'Md5',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTextHasSentences()
    {
        return $this->hasMany(TextHasSentence::className(), ['text_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSentences()
    {
        return $this->hasMany(Sentence::className(), ['id' => 'sentence_id'])->viaTable('text_has_sentence', ['text_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTextHasWords()
    {
        return $this->hasMany(TextHasWord::className(), ['text_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWordEnglishes()
    {
        return $this->hasMany(Word::className(), ['english' => 'word_english', 'russian' => 'word_russian'])->viaTable('text_has_word', ['text_id' => 'id']);
    }

    public function getTextSentences()
    {
        $sentencesArray = array();
        $sentence = strtok($this->text, ".\n!?");
        while ($sentence !== false) {
            if ($sentence != "" && $sentence != " ") $sentencesArray[] = $sentence; //предложение без последнего хнака, надо пофиксить
            $sentence = strtok(".\n!?");
        }
        return $sentencesArray;
    }

    public function getTextWords()
    {

    }
}
