<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
            [
                'attribute' => 'Ссылка',
                'value' => function ($data) {
                    return Html::   a('Просмотреть', Url::to("view?id=".$data->id), [
                        'class' => 'btn text-dark btn-sm btn-default'
                    ]);
                },
                'format' => 'raw',
                'options' => [
                    'style' => [
                        'width' => '10%'
                    ],
                ],
            ],
            [
                'label' => 'Короткое содержание',
                'value' => function ($data) {
                    $neededLength = 150;
                    $result = '';
                    $words = explode(' ', $data->content);
                    $w_length = count($words);
                    $length = 0;
                    $i = -1;
                    while ( $length < $neededLength && $i++ < $w_length && $i < count($words)) {
                        $length += strlen($words[$i]);
                        $result .= $words[$i] . ' ';
                    }
                    if ($i < count($words)) {
                        $result .= " (...)";
                    }
                    return $result;
                },
                'options' => [
                    'style' => [
                        'width' => '90%'
                    ],
                ],
            ],
    ],
    'tableOptions' => [
        'class' => 'table table-hover fixed text-center-fc border-dark',
    ],
    'headerRowOptions' => [
        'class' => 'thead-dark text-center',
    ],
    'filterRowOptions' => [
        'class' => 'bg-dark',
    ],
    'layout' => "{items}\n{pager}",
]) ?>

<p><?= Html::a('Добавить текст', Url::to('add'), ['class' => 'btn btn-success']) ?></p>


