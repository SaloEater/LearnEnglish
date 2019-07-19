<?php


namespace common\repositories;


use common\entities\Sentence;

class SentenceRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new Sentence();
    }


}