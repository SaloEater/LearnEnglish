<?php

/* @var $dataProvider  ActiveDataProvider*/
use yii\data\ActiveDataProvider;
use common\entities\UsersWords;
use yii\helpers\ArrayHelper;
$models = $dataProvider->getModels();

$countMap = ArrayHelper::map($models, 'count', 'count');

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
            'filter' => $countMap
        ],
        [
            'attribute' => 'Глобально',
            'value' => function (UsersWords $data) {
                return $data->word->count;
            },
        ],
    ],
]) ?>
