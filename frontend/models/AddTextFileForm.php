<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Text;

class AddTextFileForm extends Model
{
    //const EVENT_FILE_IS_SELECTED = 'text file';

    public $textFile;

    public function rules()
    {
        return [
            [['textFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt']
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->textFile->saveAs('texts/' . $this->textFile->baseName . '.' . $this->textFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function addText()
    {
        $text = new Text;
        $filePath = __DIR__.'/../web/texts/' . $this->textFile->baseName . '.' . $this->textFile->extension;
        $handle = fopen($filePath, 'r');
        $text->text = fread($handle, filesize($filePath));
        $text->user_id = Yii::$app->user->getId();
        $text->md5 = md5($text->text);
        fclose($handle);
        return $text->save() ? $text : null;
    }
}