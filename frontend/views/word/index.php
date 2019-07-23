<?php

/* @var $this \yii\web\View*/
/* @var $dataProvider  ActiveDataProvider*/
/* @var $filterModel \backend\models\MegaUsersWordsSearch*/

use common\entities\UsersWords;
use yii\data\ActiveDataProvider;

$view = $this;
?>

<?php

\yii\widgets\Pjax::begin([
    'enablePushState' => false
]);

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => [
        [
            'label' => 'Слово',
            'attribute' => 'word_content',
            'value' => 'word.content',
            'options' => [
                'style' => [
                    'width' => '35%'
                ],
                'class' => ''
            ],
            'headerOptions' => [
                'class' => 'text-white fixed',
            ]
        ],
        [
            'attribute' => 'status',
            'label' => 'Изучено',
            'value' => function (UsersWords $data) use ($view)  {
//                return \yii\helpers\Html::a(\lo\widgets\Toggle::widget(['name' => 'status', 'checked' => (bool)$data->status]), ['', 'id'=>$data->id]);
                return $view->render('wordStatusAjaxElement', [
                    'id' => $data->id,
                    'status' => (bool)$data->status
                ]);
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
                    'class' => 'form-control fixed',
                ]),
            'options' => [
                'style' => [
                    'width' => '10%'
                ],
            ],
            'format' => 'raw',
            'headerOptions' => [
                'class' => 'text-white fixed',
                'scope' => 'col'
            ]
        ],
        [
            'label' => 'У вас',
            'attribute' => 'order',
            'filter' => false,
            'headerOptions' => [
                'class' => 'text-white fixed',
                'scope' => 'col'
            ],
            'options' => [
                'style' => [
                    'width' => '20%'
                ]
            ],
        ],
        [
            'attribute' => 'word_order',
            'value' => 'word.order',
            'label' => 'Рейтинг глобально',
            'filter' => false,
            'headerOptions' => [
                'class' => 'text-white fixed',
                'scope' => 'col'
            ],
            'options' => [
                'style' => [
                    'width' => '20%'
                ]
            ],
        ]
    ],
    'tableOptions' => [
        'class' => 'table table-hover fixed text-right-fc text-center-sc border-dark white-link white-visited white-active',
    ],
    'layout' => "{items}\n{pager}",
    'headerRowOptions' => [
        'class' => 'thead-dark',
    ],
    'filterRowOptions' => [
        'class' => 'bg-dark',
    ],
    'rowOptions' => [
    ]
]) ?>

<?php

\yii\widgets\Pjax::end();

?>
