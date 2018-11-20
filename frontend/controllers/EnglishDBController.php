<?php

namespace frontend\controllers;

use common\models\Sentence;
use common\models\TextHasSentence;
use frontend\models\AddTextFileForm;
use frontend\models\AddTextForm;
use yii\web\Controller;
use common\models\Text;

class EnglishDBController extends Controller
{

    public static function updateEnglishDB($form)
    {
        $text = $form->addText();
        EnglishDBController::addSentences($text);
    }

    public static function addSentences(Text $text)
    {
        $sentencesArray = $text->getTextSentences();
        $wordsArray = $text->getTextWords();

        foreach ($sentencesArray as $sentence) {
            $find = Sentence::findOne([
                'content' => $sentence,
            ]);
            if (!is_object($find)) {
                $find = new Sentence();
                $find->content = $sentence;
                $find->save();

                $textHasSentence = new TextHasSentence();
                $textHasSentence->text_id = $text->id;
                $textHasSentence->sentence_id = $find->id;
                $textHasSentence->save();
            }
        }
    }

    public function addWords(Text $text)
    {

    }
}
