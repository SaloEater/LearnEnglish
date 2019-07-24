<?php


namespace common\repositories;


use common\entities\SentencesWords;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class SentencesWordsRepository extends IRepository
{
    private $innerRecord;

    public function __construct(SentencesWords $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     * @return ActiveRecord
     */
    public function getByIDs(int $sentence_id, int $word_id)
    {
        $fw = $this->getBy($this->innerRecord, [
            'sentence_id' => $sentence_id,
            'word_id' => $word_id
        ]);

        return $fw;
    }
}