<?php


namespace common\services;


use common\entities\FormsWords;
use common\repositories\FormsWordsRepository;

class FormsWordsService
{
    private $formswords;

    public function __construct(FormsWordsRepository $formswords)
    {
        $this->formswords = $formswords;
    }

    /**
     * @param int $form_id
     * @param int $word_id
     * @throws \yii\web\NotFoundHttpException
     */
    public function EstablishLinkBetween(int $form_id, int $word_id)
    {
        $this->getByIDs($form_id, $word_id);
    }

    /**
     * @param int $form_id
     * @param int $word_id
     * @return FormsWords|\yii\db\ActiveRecord
     * @throws \yii\web\NotFoundHttpException
     */
    public function getByIDs(int $form_id, int $word_id)
    {
        try {
            $form = $this->formswords->getByIDs($form_id, $word_id);
        } catch(\DomainException $e) {
            $form = $this->createWithIDs($form_id, $word_id);
        }
        return $form;
    }

    /**
     * @param int $form_id
     * @param int $word_id
     * @return FormsWords
     */
    public function createWithIDs(int $form_id, int $word_id)
    {
        $formswords = new FormsWords();
        $formswords->word_id = $word_id;
        $formswords->form_id = $form_id;
        $this->save($formswords);
        return $formswords;
    }

    /**
     * @param FormsWords $formsWords
     */
    public function save(FormsWords $formsWords)
    {
        if (!$formsWords->save()) {
            throw new \RuntimeException('Forms words saving error');
        }
    }
}