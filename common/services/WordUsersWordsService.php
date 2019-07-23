<?php

namespace common\services;

use common\repositories\UsersWordsRepository;
use common\repositories\WordRepository;
use common\entities\Word;
use yii\base\InvalidArgumentException;

class WordUsersWordsService
{
    protected $userswords;
    protected $words;

    public function __construct ()
    {
        $this->userswords = new UsersWordsRepository();
        $this->words = new WordRepository();
    }

    public function order($model, string $repository)
    {
        $count = $model->count;
        $beforeUs = $this->{$repository}->countItemsbeforeUs($count);
        $items = $this->{$repository}->countItemsOnLevel($count);
        if ($repository == "userswords") {
            foreach ($items as $item) {
                $wordContent = ($model->word->content);
                $gotWordContent = (Word::findOne($item['word_id']))->content;
                if ((strcmp($wordContent, $gotWordContent)) == 1) {
                    $beforeUs++;
                }
            }
        } elseif ($repository == "words") {
            foreach ($items as $item) {
                $wordContent = $model->content;
                if ((strcmp($wordContent, $item['content'])) == 1) {
                    $beforeUs++;
                }
            }
        } else throw new InvalidArgumentException();
        $this->{$repository}->updateOrders($beforeUs, $model->order);
        $model->order = $beforeUs+1;
        return $model;
    }

}