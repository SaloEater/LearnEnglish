<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $user \common\entities\User */
?>

<div class="left-padding">
    <div class="display-2 ">
       Имя пользователя <b><?= $user->username?></b>
    </div>
</div>

<div class="container">
    <p><?= Html::a('Мои тексты' , Url::to('/text/'), [
            'class' => 'btn btn-lg btn-default'
        ])?></p>
    <p><?= Html::a('Мои слова' , Url::to('/word/'), [
        'class' => 'btn btn-lg btn-default'
    ])?></p>
</div>