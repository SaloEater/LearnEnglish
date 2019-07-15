<?php

namespace common\services;

use common\models\Translation;
use common\repositories\TranslationRepository;
use yii\web\NotFoundHttpException;

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
     * @return Translation
     */
    public function createWithContentAndType(string $content, string $type)
    {
        $translation = new Translation();
        $translation->content = $content;
        $translation->type = $type;
        $this->save($translation);
        return $translation;
    }

    /**
     * @param string $content
     * @param string $type
     * @return Translation|\yii\db\ActiveRecord
     */
    public function getByContentAndType(string $content, string $type)
    {
        try {
            $form = $this->translations->getByTrAndType($content, $type);
        } catch(\DomainException $e) {
            $form = $this->createWithContentAndType($content, $type);
        }
        return $form;
    }

    public function save(Translation $form)
    {
        if (!$form->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}