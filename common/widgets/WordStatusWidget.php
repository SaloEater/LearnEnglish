<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 21.07.2019
 * Time: 15:37
 */

namespace common\widgets;


use lo\widgets\Toggle;
use yii\base\Widget;

class WordStatusWidget extends Widget
{
    public $id;
    public $status;

    public function run()
    {
        $id = $this->id;
        $token = \Yii::$app->request->getCsrfToken();
        echo Toggle::widget([
            'name' => $id,
            'checked' => $this->status,
            'clientEvents' => [
                    'change' => <<<JS
                        function(e){
                            $.ajax({url: "/word/status",
                                type: "post",
                                data: {
                                            id: "$id",
                                     _csrf : "$token"
                                },
                                success: function(result) {
                                    parent = $(e.currentTarget)[0]['parentElement'];
                                    if (!result.known) {
                                        $(parent).toggleClass('btn-success btn-danger off')
                                    }
                                },
                                error: function(xhr) {
                                    alert("An error occured: " + xhr.status + " " + xhr.statusText);
                                }
                            });
                        }
JS
            ],
            'options' => [
                'data-on' => 'Да',
                'data-off' => 'Нет',
            ]
        ]);
    }

}