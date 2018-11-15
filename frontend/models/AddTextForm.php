<?php

namespace frontend\models;

use yii\base\Model;

class AddTextForm extends Model
{
    public $text;

    public function rules()
    {
        return [
            [['text'], 'required', 'message' => 'No text pasted'],
        ];
    }
}