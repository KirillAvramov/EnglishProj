<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_has_word".
 *
 * @property int $user_id
 * @property string $word_english
 * @property string $word_russian
 * @property int $amount
 *
 * @property User $user
 * @property Word $wordEnglish
 */
class UserHasWord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_has_word';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'word_english', 'word_russian'], 'required'],
            [['user_id', 'amount'], 'integer'],
            [['word_english', 'word_russian'], 'string', 'max' => 45],
            [['user_id', 'word_english', 'word_russian'], 'unique', 'targetAttribute' => ['user_id', 'word_english', 'word_russian']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['word_english', 'word_russian'], 'exist', 'skipOnError' => true, 'targetClass' => Word::className(), 'targetAttribute' => ['word_english' => 'english', 'word_russian' => 'russian']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'word_english' => 'Word English',
            'word_russian' => 'Word Russian',
            'amount' => 'Amount',
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
    public function getWordEnglish()
    {
        return $this->hasOne(Word::className(), ['english' => 'word_english', 'russian' => 'word_russian']);
    }
}
