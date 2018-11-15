<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

$this->title = 'Add Text';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-text-adding">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Here you can paste or select the text you want to translate:</p>

    <?php $pasteForm = ActiveForm::begin(['id' => 'add-text']) ?>

        <?= $pasteForm->field($text, 'text')->textarea(['rows' => 6]) ?>

        <?= Html::submitButton('Submit') ?>

    <?php ActiveForm::end(); ?>

    <?php $pasteForm = ActiveForm::begin(['id' => 'add-text-file', 'options' => ['enctype' => 'multipart/form-data'],]) ?>

        <?= $pasteForm->field($file, 'textFile')->fileInput()?>

        <?= Html::submitButton('Submit') ?>

    <?php ActiveForm::end(); ?>

</div>
