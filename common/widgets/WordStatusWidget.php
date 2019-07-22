<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21.07.2019
 * Time: 15:37
 */

namespace common\widgets;


use yii\base\Widget;
use yii\helpers\Url;

class WordStatusWidget extends Widget
{
    public $entity;
    public $preparedURl;


    public function run()
    {
        //$output = \yii\helpers\Html::a('Изменить', Url::to(['','id'=>$this->entity->id])/*$this->preparedURl.'&id='.$this->entity->id*/, ['class' => 'btn btn-small'.(((bool)$this->entity->status)?' btn-success':' btn-danger')]);
        $output = \yii\helpers\Html::submitButton('Изменить', [
                'url' => Url::to(['','id'=>$this->entity->id]),
                'class' => 'btn btn-small'.(((bool)$this->entity->status)?' btn-success':' btn-danger'),
            ]
        );

        echo $output;
    }
}