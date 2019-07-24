<?php

/* @var $user User */

use common\entities\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm; ?>

<div class="container">

    <?php $form = ActiveForm::begin()?>

    <?= $form->field($user, 'image_url')->textInput(['value' => $user->image_url, 'style' => 'width: 15rem'])->label('Изменить изображение')?>

    <?=  Html::submitButton('Сохранить!', ['class' => 'btn btn-success']); ?>
    <?php ActiveForm::end()?>
</div>





