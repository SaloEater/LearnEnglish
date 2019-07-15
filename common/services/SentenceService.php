<?php


namespace common\services;


use common\models\Sentence;
use common\repositories\SentenceRepository;

class SentenceService
{
    private $sentences;

    public function __construct()
    {
        $this->sentences = new SentenceRepository();
    }

    public function save(Sentence $sentence)
    {
        if (!$sentence->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }

}