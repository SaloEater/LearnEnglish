<?php

use common\repositories\IRepository;
use common\models\Word;

class WordRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Word::class;
    }


}