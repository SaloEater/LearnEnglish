<?php

namespace common\services;

use common\entities\Translation;
use common\repositories\TranslationRepository;

class TranslationService
{
    private $translations;

    public function __construct()
    {
        $this->translations = new TranslationRepository();
    }

    /**
     * @param string $content
     * @param string $type
     * @param int $word_id
     * @param int $sort
     * @return Translation
     */
    public function createWithContentAndTypeForWord(string $content, string $type, int $word_id, int $sort)
    {
        $translation = new Translation();
        $translation->content = $content;
        $translation->type = $type;
        $translation->word_id = $word_id;
        $translation->sort = $sort;
        $this->save($translation);
        return $translation;
    }

    /**
     * @param string $content
     * @param string $type
     * @return Translation|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function ensureExists(string $content, string $type, int $word_id, $sort)
    {
        try {
            $translation = $this->translations->getByTrAndTypeForWord($content, $type, $word_id);
        } catch(\DomainException $e) {
            $translation = $this->createWithContentAndTypeForWord($content, $type, $word_id, $sort);
        }
        return $translation;
    }

    /**
     * @param Translation $form
     */
    public function save(Translation $form)
    {
        if (!$form->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}