<?php

use common\repositories\IRepository;
use common\models\Form;

class FormRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Form::class;
    }


}