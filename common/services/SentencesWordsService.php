<?php


namespace common\services;


use common\entities\SentencesWords;
use common\repositories\SentencesWordsRepository;

class SentencesWordsService
{
    private $sentenceswords;

    public function __construct(SentencesWordsRepository $sentenceswords)
    {
        $this->sentenceswords = $sentenceswords;
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     * @throws \yii\web\NotFoundHttpException
     */
    public function EstablishLinkBetween(int $sentence_id, int $word_id)
    {
        $this->getByIDs($sentence_id, $word_id);
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     * @return SentencesWords|\yii\db\ActiveRecord
     * @throws \yii\web\NotFoundHttpException
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
            throw new \RuntimeException('SentencesWords saving error');
        }
    }
}