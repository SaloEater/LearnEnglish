<?php


namespace common\services;


use common\models\SentencesWords;
use common\repositories\SentencesWordsRepository;
use yii\web\NotFoundHttpException;

class SentencesWordsService
{
    private $sentenceswords;

    public function __construct()
    {
        $this->sentenceswords = new SentencesWordsRepository();
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     */
    public function EstablishLinkBetween(int $sentence_id, int $word_id)
    {
        $this->getByIDs($sentence_id, $word_id);
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     * @return SentencesWords|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByIDs(int $sentence_id, int $word_id)
    {
        try {
            $form = $this->sentenceswords->getByIDs($sentence_id, $word_id);
        } catch(\DomainException $e) {
            $form = $this->createWithIDs($sentence_id, $word_id);
        }
        return $form;
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     * @return SentencesWords
     */
    public function createWithIDs(int $sentence_id, int $word_id)
    {
        $sentenceword = new SentencesWords();
        $sentenceword->word_id = $word_id;
        $sentenceword->sentence_id = $sentence_id;
        $this->save($sentenceword);
        return $sentenceword;
    }

    /**
     * @param SentencesWords $formsWords
     */
    public function save(SentencesWords $formsWords)
    {
        if (!$formsWords->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}