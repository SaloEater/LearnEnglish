<?php


namespace common\repositories;


use common\entities\Text;
use yii\web\NotFoundHttpException;

class TextRepository extends IRepository
{
    private $innerRecord;

    public function __construct(Text $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    public function getById(int $id)
    {
        $text = $this->getBy($this->innerRecord, ['id' => $id]);
        return $text;
    }
}