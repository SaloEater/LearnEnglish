<?php
namespace common\repositories;
use common\repositories\IRepository;
use common\models\Word;
use yii\web\NotFoundHttpException;

class WordRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Word::class;
    }


    /**
     * @param string $content
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByContent(string $content)
    {
        if (!$form = $this->getBy([
            'content' => $content
        ])) {
            throw new NotFoundHttpException('Form is not found');
        }

        return $form;
    }
}