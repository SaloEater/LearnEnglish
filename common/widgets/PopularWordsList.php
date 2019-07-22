<?php


namespace common\widgets;


use common\services\WordService;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

class PopularWordsList extends Widget
{

    public function run()
    {
        $output = "<div class='w-25 d-inline-block'>";
        $output .= "<h3 class='text-center '>Популярные слова</h3>";
        $output .= "<ul class='list-group'>";

        $topWords = (new WordService())->getTopWords();

        foreach($topWords->all() as $item) {
            $output .= "<li class='list-group-item'>" . $item->content . "</li>";
        }

        $output .= "</ul>";
        $output .= "</div>";
        return $output;
    }

}