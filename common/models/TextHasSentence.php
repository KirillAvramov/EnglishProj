<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "text_has_sentence".
 *
 * @property int $text_id
 * @property int $sentence_id
 *
 * @property Sentence $sentence
 * @property Text $text
 */
class TextHasSentence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'text_has_sentence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text_id', 'sentence_id'], 'required'],
            [['text_id', 'sentence_id'], 'integer'],
            [['text_id', 'sentence_id'], 'unique', 'targetAttribute' => ['text_id', 'sentence_id']],
            [['sentence_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sentence::className(), 'targetAttribute' => ['sentence_id' => 'id']],
            [['text_id'], 'exist', 'skipOnError' => true, 'targetClass' => Text::className(), 'targetAttribute' => ['text_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'text_id' => 'Text ID',
            'sentence_id' => 'Sentence ID',
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
    public function getText()
    {
        return $this->hasOne(Text::className(), ['id' => 'text_id']);
    }
}
