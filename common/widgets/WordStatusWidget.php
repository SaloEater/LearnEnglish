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
    public $id;
    public $status;

    public function run()
    {
        $output = \yii\helpers\Html::button(
            'Изменить',
            [
                'id' => 'ws'.$this->id,
                'class' => 'btn btn-small'.($this->status?' btn-success':' btn-danger')
            ]
        );
        /*$output = \yii\helpers\Html::submitButton('Изменить', [
                'url' => Url::to(['','id'=>$this->id]),
                'class' => 'btn btn-small'.(((bool)$this->status)?' btn-success':' btn-danger'),
            ]
        );*/

        echo $output;
        $this->registerScript();
    }

    public function registerScript()
    {
        $id = $this->id;
        $token = \Yii::$app->request->getCsrfToken();
        $js = <<<JS
$("#ws$id").click(function(){
            $.ajax({url: "/word/status", 
                type: "post",
                data: {
                    id: "$id",
                     _csrf : "$token"
                },
                success: function(result) {
                    if (result.known) {
                        $("#ws$id").toggleClass("btn-success btn-danger");
                    } else {
                        $("#ws$id").toggleClass("btn-success btn-danger");                        
                    }
                },
                error: function(xhr) {
                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                }            
            });
        });
JS;
        $this->view->registerJs($js);
    }

}