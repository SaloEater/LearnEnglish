<?php

namespace common\repositories;

use common\models\Form;
use yii\web\NotFoundHttpException;

class FormRepository extends IRepository
{
    public function __construct()
    {
        $this->type = Form::class;
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