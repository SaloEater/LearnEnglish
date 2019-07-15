<?php

namespace common\services;

use common\models\Form;
use common\models\Word;
use common\repositories\WordRepository;
use yii\web\NotFoundHttpException;

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
        $this->save($word);
        return $word;
    }

    /**
     * @param string $content
     * @return Word
     */
    public function getByContent(string $content)
    {
        try {
            $form = $this->words->getByContent($content);
        } catch(\DomainException $e) {
            $form = $this->createWithContent($content);
        }
        return $form;
    }

    /**
     * @param Form $form
     */
    public function save(Word $word)
    {
        if (!$word->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}