<?php
namespace common\repositories;
use common\entities\Translation;
use yii\web\NotFoundHttpException;

class TranslationRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new Translation();
    }

    /**
     * @param string $content
     * @param string $type
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByTrAndTypeForWord(string $content, string $type, int $word_id)
    {
        $form = $this->getBy([
            'content' => $content,
            'type' => $type,
            'word_id' => $word_id
        ]);

        return $form;
    }
}