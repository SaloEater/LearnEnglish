<?php

/* @var $this \yii\web\View*/
/* @var $dataProvider  ActiveDataProvider*/
/* @var $filterModel \backend\models\MegaUsersWordsSearch*/
/* @var $preparedURl string*/

use common\entities\UsersWords;
use yii\data\ActiveDataProvider;

$view = $this;
?>

<?php

//\yii\widgets\Pjax::begin([
//    'enablePushState' => false
//]);

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $filterModel,
    'columns' => [
        [
            'label' => 'Слово',
            'attribute' => 'word_content',
            'value' => 'word.content',
        ],
        [
            'attribute' => 'status',
            'value' => function (UsersWords $data) use ($preparedURl, $view)  {
                //return $data->status;
//                return \yii\helpers\Html::a(\lo\widgets\Toggle::widget(['name' => 'status', 'checked' => (bool)$data->status]), ['', 'id'=>$data->id]);
//                return \yii\helpers\Html::a('Изменить', $data->id, ['class' => 'btn btn-small '.(((bool)$data->status)?'btn-success':'btn-danger')]);
                return $view->render('wordStatusAjaxElement', [
                    'entity' => $data,
                    'preparedURl' => $preparedURl,
                    'view' => $view
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
                    'class' => 'form-control',
                ]),
            'options' => [
                'style' => [
                    'width' => '15rem'
                ]
            ],
            'format' => 'raw'
        ],
        [
            'label' => 'У вас',
            'attribute' => 'order',
            'filter' => false
        ],
        [
            'attribute' => 'word_order',
            'value' => 'word.order',
            'label' => 'Рейтинг глобально',
            'filter' => false
        ]
    ],
]) ?>

<?php

//\yii\widgets\Pjax::end();

?>
