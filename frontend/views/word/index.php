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


/*$globalCountMap = ArrayHelper::map($models, 'word.count', 'word.count');
$countMap = ArrayHelper::map($models, 'count', 'count');*/

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
                    'class' => 'form-control'
                ]),/*[
                '0' => 'Не изучено',
                '1' => 'Изучено',
            ]*/
        ],
        [
            'label' => 'У вас',
            'attribute' => 'order',
            'filter' => false
        ],
        [
            'attribute' => 'word',
            'value' => 'word.order',
            'label' => 'Рейтинг глобально',
            'filter' => false
        ]
    ],
]) ?>
