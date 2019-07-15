<?php
namespace common\repositories;
use common\models\Translation;
use yii\web\NotFoundHttpException;

class TranslationRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Translation::class;
    }

    /**
     * @param string $content
     * @param string $type
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByTrAndType(string $content, string $type)
    {
        if (!$form = $this->getBy([
            'content' => $content,
            'type' => $type
        ])) {
            throw new NotFoundHttpException('Translation is not found');
        }

        return $form;
    }
}