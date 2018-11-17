<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "infinitive".
 *
 * @property string $english
 * @property string $russian
 *
 * @property Word[] $words
 */
class Infinitive extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'infinitive';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['english', 'russian'], 'required'],
            [['english', 'russian'], 'string', 'max' => 45],
            [['english', 'russian'], 'unique', 'targetAttribute' => ['english', 'russian']],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWords()
    {
        return $this->hasMany(Word::className(), ['infinitive_english' => 'english', 'infinitive_russian' => 'russian']);
    }
}
