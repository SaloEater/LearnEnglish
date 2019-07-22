<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $user \common\entities\User */

?>

<div class="float-left">
    <?= Html::img($user->image_url); ?>
    <div class=" pt-1">

        <?= $user->username ?>

       <?= Html::a('Ваш профиль' , Url::to('edit'), [
           'class' => 'btn btn-lg btn-default btn-block display-4'
       ])?>
    </div>
</div>

<div class="container" style="padding-top: 2rem">
    <p><?= Html::a('Мои тексты' , Url::to('/text/'), [
            'class' => 'btn btn-lg btn-default'
        ])?></p>
    <p><?= Html::a('Мои слова' , Url::to('/word/'), [
        'class' => 'btn btn-lg btn-default'
    ])?></p>
</div>