<?php

/* @var $dataProvider  ActiveDataProvider*/
/* @var $filterModel \backend\models\UsersWordsSearch*/
use yii\data\ActiveDataProvider;
use common\entities\UsersWords;
use yii\helpers\ArrayHelper;
$models = $dataProvider->getModels();

$countMap = ArrayHelper::map($models, 'count', 'count');

$globalCountMap = ArrayHelper::map($models, 'count', 'word.count');

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => [
        [
            'label' => 'Слово',
            'value' => function (UsersWords $data) {
                return $data->word->content;
            },
//            'filter' => false
        ],
        [
            'attribute' => 'status',
            'value' => function (UsersWords $data) {
                return $data->status;
            },
            'filter' => [
                '0' => 'Не изучено',
                '1' => 'Изучено',
            ]
        ],
        [
            'label' => 'У вас',
            'attribute' => 'count',
            'value' => function (UsersWords $data) {
                return $data->count;
            },
            'filter' => $countMap
        ],
        [
            'attribute' => 'word',
            'value' => 'word.count',
            'label' => 'Глобально',
            'filter' => $globalCountMap
        ]
    ],
]) ?>
