<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\UsersWords;

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'Слово',
            'value' => function (UsersWords $data) {
                return $data->word->content;
            },
        ],
        [
            'attribute' => 'Статус',
            'value' => function (UsersWords $data) {
                return $data->status;
            },
        ],
        [
            'attribute' => 'У вас',
            'value' => function (UsersWords $data) {
                return $data->count;
            },
        ],
        [
            'attribute' => 'Глобально',
            'value' => function (UsersWords $data) {
                return $data->word->count;
            },
        ],
    ],
]) ?>
