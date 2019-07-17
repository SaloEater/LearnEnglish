<?php


namespace common\services;


use common\entities\Sentence;
use common\repositories\SentenceRepository;

class SentenceService
{
    private $sentences;

    public function __construct()
    {
        $this->sentences = new SentenceRepository();
    }

    /**
     * @param Sentence $sentence
     */
    public function save(Sentence $sentence)
    {
        if (!$sentence->save()) {
            throw new \RuntimeException('Form saving error');
        }
    }

}