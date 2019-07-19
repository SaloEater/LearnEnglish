<?php

namespace common\services;

use common\entities\Word;
use common\repositories\WordRepository;
use yii\web\NotFoundHttpException;
use \yii\db\Query;

class WordService
{
    private $words;

    public function __construct()
    {
        $this->words = new WordRepository();
    }

    /**
     * @param string $content
     * @return Word
     */
    public function createWithContent(string $content)
    {
        $word = new Word();
        $word->content = $content;
        $this->save($word, false);
        return $word;
    }

    /**
     * @param string $content
     * @return Word|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByContent(string $content)
    {
        try {
            $word = $this->words->getByContent($content);
        } catch(\DomainException $e) {
            $word = $this->createWithContent($content);
        }
        return $word;
    }

    public function setOrder(Word $word)
    {
        $count = $word->count;
        $beforeUS = $this->words->countWordsBeforeUs($count);
        $items = $this->words->countWordsOnLevel($count);
        foreach ($items as $item) {
            $wordContent = $word->content;
            if ((strcmp($wordContent, $item['content'])) == 1) {
                $beforeUS++;
            }
        }
        if ($word->order) {
            $b = \Yii::$app->db->createCommand('UPDATE `word` SET `order`=`order`+1 WHERE `order`<' . $word->order . ' AND ' . '`order`>' . $beforeUS);
//                $b = \Yii::$app->db->createCommand()->update(Word::tableName(), ['order' => 'order+1'], 'order > ' . $beforeUS . 'AND' . 'order <  ' . $word->order);
            $b->execute();
        } else {
//                $b = \Yii::$app->db->createCommand()->update(Word::tableName(), ['order' => 'order+1'], 'order > ' . $beforeUS);
            $b = \Yii::$app->db->createCommand('UPDATE `word` SET `order`=`order`+1 WHERE `order`>' . $beforeUS);
            $b->execute();
        }
        $word->order = $beforeUS+1;
        return $word;
    }

    /**
     * @param Word $word
     * @param bool $increment
     */
    public function save(Word $word, $increment = true)
    {
        if ($increment) {
            $word->count++;
            $this->setOrder($word);
        }
        if (!$word->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}