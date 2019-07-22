<?php

namespace common\services;

use common\entities\Word;
use yii\web\NotFoundHttpException;

class WordService extends WordUsersWordsService
{

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
        $word = $this->order($word, "words");
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