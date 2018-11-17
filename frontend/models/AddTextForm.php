<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Text;

class AddTextForm extends Model
{
    //const EVENT_TEXT_IS_PASTED = 'text';

    public $text;

    public function rules()
    {
        return [
            [['text'], 'required', 'message' => 'No text pasted'],
        ];
    }


    public function addText()
    {
        $text = new Text;
        $text->text = $this->text;
        $text->user_id = Yii::$app->user->getId();
        $text->md5 = md5($this->text);

        return $text->save() ? $text : null;
    }
}