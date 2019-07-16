<?php


namespace common\repositories;


use common\models\Text;
use yii\web\NotFoundHttpException;

class TextRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Text::class;
    }

    public function getById(int $id)
    {
        if (!($text = $this->getBy(['id' => $id]))) {
            throw new NotFoundHttpException("Text isn't found");
        }
        return $text;
    }
}