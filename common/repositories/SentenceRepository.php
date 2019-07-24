<?php


namespace common\repositories;


use common\entities\Sentence;

class SentenceRepository extends IRepository
{
    private $innerRecord;

    public function __construct(Sentence $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    public function getById($id) {
        $sentence = $this->getBy($this->innerRecord, ['id' => $id]);
        return $sentence;
    }
}