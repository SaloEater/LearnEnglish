<?php

namespace common\repositories;

use common\entities\Form;
use common\entities\FormsWords;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

class FormRepository extends IRepository
{
    private $innerRecord;

    public function __construct(Form $innerRecord)
    {
        $this->innerRecord = $innerRecord;
    }

    /**
     * @param string $content
     * @return ActiveRecord
     */
    public function getByContent(string $content)
    {
        $form = $this->getBy($this->innerRecord, [
            'content' => $content
        ]);

        return $form;
    }
}