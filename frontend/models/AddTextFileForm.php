<?php

namespace frontend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class AddTextFileForm extends Model
{
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
}