<?php


namespace common\repositories;


use common\entities\FormsWords;
use yii\web\NotFoundHttpException;

class FormsWordsRepository extends IRepository
{
    public function __construct()
    {
        $this->type = FormsWords::class;
    }

    /**
     * @param int $form_id
     * @param int $word_id
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByIDs(int $form_id, int $word_id)
    {
        if (!$fw = $this->getBy([
            'form_id' => $form_id,
            'word_id' => $word_id
        ])) {
            throw new NotFoundHttpException('Form is not found');
        }

        return $fw;
    }
}