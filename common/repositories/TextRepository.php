<?php


namespace common\repositories;


use common\entities\Text;
use yii\web\NotFoundHttpException;

class TextRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new Text();
    }

    public function getById(int $id)
    {
        if (!($text = $this->getBy(['id' => $id]))) {
            throw new NotFoundHttpException("Text isn't found");
        }
        return $text;
    }
}