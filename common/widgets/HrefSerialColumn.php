<?php


namespace common\widgets;

use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;

class HrefSerialColumn extends SerialColumn
{
    /**
    * {@inheritdoc}
    */
    public $header = 'Ссылка';
    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return Html::a(parent::renderDataCellContent($model, $key, $index), Url::to("view?id=".($index+1)), [
            'class' => 'btn btn-sm btn-default'
        ]);
    }
}