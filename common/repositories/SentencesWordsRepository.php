<?php


namespace common\repositories;


use common\models\SentencesWords;
use yii\web\NotFoundHttpException;

class SentencesWordsRepository extends IRepository
{
    public function __construct()
    {
        $this->type = SentencesWords::class;
    }


    public function getByIDs(int $sentence_id, int $word_id)
    {
        if (!$fw = $this->getBy([
            'sentence_id' => $sentence_id,
            'word_id' => $word_id
        ])) {
            throw new NotFoundHttpException('Form is not found');
        }

        return $fw;
    }
}