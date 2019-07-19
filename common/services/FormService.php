<?php

namespace common\services;

use common\entities\Form;
use common\repositories\FormRepository;

class FormService
{
    private $services;

    public function __construct()
    {
        $this->services = new FormRepository();
    }

    /**
     * @param string $content
     * @return Form
     */
    public function createWithContent(string $content)
    {
        $form = new Form();
        $form->content = $content;
        $this->save($form, false);
        return $form;
    }

    /**
     * @param string $content
     * @return Form|\yii\db\ActiveRecord
     * @throws \yii\web\NotFoundHttpException
     */
    public function getByContent(string $content)
    {
        try {
            $form = $this->services->getByContent($content);
        } catch(\DomainException $e) {
            $form = $this->createWithContent($content);
        }
        return $form;
    }

    /**
     * @param Form $form
     * @param bool $increment
     */
    public function save(Form $form, $increment = true)
    {
        if ($increment) {
            $form->count++;
        }
        if (!$form->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }
}