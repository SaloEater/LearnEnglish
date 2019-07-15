<?php


namespace common\repositories;


use common\models\FormsWords;
use yii\web\NotFoundHttpException;

class FormsWordsRepository extends IRepository
{
    public function __construct()
    {
        $this->type = FormsWords::class;
    }


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