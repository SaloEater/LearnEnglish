<?php


namespace common\services;


use common\models\FormsWords;
use common\repositories\FormsWordsRepository;
use yii\web\NotFoundHttpException;

class FormsWordsService
{
    private $formswords;

    public function __construct()
    {
        $this->formswords = new FormsWordsRepository();
    }

    public function EstablishLinkBetween(int $form_id, int $word_id)
    {
        $this->getByIDs($form_id, $word_id);
    }


    public function getByIDs(int $form_id, int $word_id)
    {
        try {
            $form = $this->formswords->getByIDs($form_id, $word_id);
        } catch(\DomainException $e) {
            $form = $this->createWithIDs($form_id, $word_id);
        }
        return $form;
    }


    public function createWithIDs(int $form_id, int $word_id)
    {
        $formswords = new FormsWords();
        $formswords->word_id = $word_id;
        $formswords->form_id = $form_id;
        $this->save($formswords);
        return $formswords;
    }


    public function save(FormsWords $formsWords)
    {
        if (!$formsWords->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}