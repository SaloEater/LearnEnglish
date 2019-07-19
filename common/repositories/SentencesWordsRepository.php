<?php


namespace common\repositories;


use common\entities\SentencesWords;
use yii\web\NotFoundHttpException;

class SentencesWordsRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new SentencesWords();
    }

    /**
     * @param int $sentence_id
     * @param int $word_id
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByIDs(int $sentence_id, int $word_id)
    {
        $fw = $this->getBy([
            'sentence_id' => $sentence_id,
            'word_id' => $word_id
        ]);

        return $fw;
    }
}