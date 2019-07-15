<?php

use common\repositories\IRepository;
use common\models\Translation;

class TranslationRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Translation::class;
    }


}