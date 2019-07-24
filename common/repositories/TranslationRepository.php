<?php
namespace common\repositories;
use common\entities\Translation;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class TranslationRepository extends IRepository
{
    private $innerRecord;

    public function __construct(Translation $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    /**
     * @param string $content
     * @param string $type
     * @param int $word_id
     * @return ActiveRecord
     */
    public function getByTrAndTypeForWord(string $content, string $type, int $word_id)
    {
        $form = $this->getBy($this->innerRecord, [
            'content' => $content,
            'type' => $type,
            'word_id' => $word_id
        ]);

        return $form;
    }
}