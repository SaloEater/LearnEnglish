<?php
namespace common\widgets;

use common\services\WordService;
use Yii;
use yii\base\Widget;
use yii\db\ActiveQuery;

class PopularWordsList extends Widget
{

    public function run()
    {
        $output = "<div class='w-25'>";
        $output .= "<h3 class='text-center '>Популярные слова</h3>";
        $output .= "<table class='table'>";
        $output .= "<thead><tr><th scope='col'>Топ</th><th scope='col'>Слово</th></tr></thead><tbody>";

        /* @var $topWords ActiveQuery*/
        $topWords = Yii::createObject(WordService::class)->getTopWords();

        $i = 1;
        foreach($topWords->all() as $item) {
            $output .= '<tr><th scope="row" class="text-right" style="width: 2rem">'.$i++.'</th><td>'.$item->content.'</td></tr>';
        }

        $output .= "</tbody>";
        $output .= "</table>";
        $output .= "</div>";
        return $output;
    }

}