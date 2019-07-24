<?php


namespace common\repositories;


use common\entities\FormsWords;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class FormsWordsRepository extends IRepository
{
    private $innerRecord;

    public function __construct(FormsWords $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    /**
     * @param int $form_id
     * @param int $word_id
     * @return ActiveRecord
     */
    public function getByIDs(int $form_id, int $word_id)
    {
        $fw = $this->getBy($this->innerRecord, [
            'form_id' => $form_id,
            'word_id' => $word_id
        ]);

        return $fw;
    }
}