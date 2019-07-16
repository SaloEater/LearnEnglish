<?php

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?= \yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
            [
                'attribute' => 'Ссылка',
                'value' => function ($data) {
                    return Html::a('Просмотреть', Url::to("view?id=".$data->id), [
                        'class' => 'btn btn-sm btn-default'
                    ]);
                },
                'format' => 'raw'
            ],
            [
                'attribute' => 'Text',
                'value' => function ($data) {
                    $result = '';
                    $words = explode(' ', $data->content);
                    $w_length = count($words);
                    $length = 0;
                    $i = -1;
                    while ( $length < 50 && $i++ < $w_length && $i < count($words)) {
                        $length += strlen($words[$i]);
                        $result .= $words[$i] . ' ';
                    }
                    if ($i < count($words)) {
                        $result .= " (...)";
                    }
                    return $result;
                },
            ],
    ],
]) ?>

<p><?= \yii\helpers\Html::a('Добавить текст', \yii\helpers\Url::to('add'), ['class' => 'btn btn-success']) ?></p>


