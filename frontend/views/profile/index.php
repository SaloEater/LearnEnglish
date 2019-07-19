<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $user \common\entities\User */

?>

<div class="left-padding">
    <div style="display:inline-block;">
        <?=
        Html::img($user->image_url);
        ?>
    </div>
    <div style="display:inline-block;padding-left:2rem;" class="display-2 ">
       Добро пожаловать, <b><?= Html::a($user->username, ['edit'])?></b>!
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