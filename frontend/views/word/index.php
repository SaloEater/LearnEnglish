<?php

/* @var $dataProvider  ActiveDataProvider*/
/* @var $filterModel \backend\models\MegaUsersWordsSearch*/
/*
 * [
                'prompt' => 'All',
            ]
 */

use yii\data\ActiveDataProvider;
use common\entities\UsersWords;
use yii\helpers\ArrayHelper;
$models = $dataProvider->getModels();

$countMap = ArrayHelper::map($models, 'count', 'count');

$globalCountMap = ArrayHelper::map($models, 'word.count', 'word.count');

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
            'filter' => \yii\helpers\Html::activeDropDownList($filterModel,
                'status',
                [
                    '0' => 'Не изучено',
                    '1' => 'Изучено',
                ],
                [
                    'prompt' => [
                        'text' => 'Все',
                        'options' => ['value'=>""]
                    ],
                    'data' => [
                        'pjax' => true,
                    ],
                    'class' => 'form-control'
                ]),
        ],
        [
            'label' => 'У вас',
            'attribute' => 'count',
            'value' => function (UsersWords $data) {
                return $data->count;
            },
            'filter' => \yii\helpers\Html::activeDropDownList($filterModel,
                'count',
                $countMap,
                [
                    'prompt' => [
                        'text' => 'Все',
                        'options' => ['value'=>""]
                    ],
                    'class' => 'form-control'
                ]),
        ],
        [
            'attribute' => 'word',
            'value' => 'word.count',
            'label' => 'Глобально',
            'filter' => \yii\helpers\Html::activeDropDownList($filterModel,
                'word',
                [
                    'prompt' => [
                        'text' => 'Все',
                        'options' => ['value'=>""]
                    ],
                    'class' => 'form-control'
                ]),
        ]
    ],
]) ?>
