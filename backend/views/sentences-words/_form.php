<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\entities\SentencesWords */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sentences-words-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sentence_id')->textInput() ?>

    <?= $form->field($model, 'word_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
