<?php

namespace common\repositories;

use common\entities\Form;
use yii\web\NotFoundHttpException;

class FormRepository extends IRepository
{
    public function __construct()
    {
        $this->type = new Form();
    }

    /**
     * @param string $content
     * @return \yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function getByContent(string $content)
    {
        $form = $this->getBy([
            'content' => $content
        ]);

        return $form;
    }
}