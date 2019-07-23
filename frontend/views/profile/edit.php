<?php

/* @var $user \common\entities\User */

use yii\helpers\Html;
use yii\helpers\Url; ?>

<div class="container">

    <?php $form = \yii\widgets\ActiveForm::begin()?>

    <?= $form->field($user, 'image_url')->textInput(['value' => $user->image_url, 'style' => 'width: 15rem'])->label('Изменить изображение')?>

    <?=  Html::submitButton('Сохранить!', ['class' => 'btn btn-success']); ?>
    <?php \yii\widgets\ActiveForm::end()?>
</div>





