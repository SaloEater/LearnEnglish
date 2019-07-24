<?php


namespace common\services;


use common\entities\Sentence;
use common\repositories\SentenceRepository;
use RuntimeException;

class SentenceService
{
    private $sentences;

    public function __construct(SentenceRepository $sentences)
    {
        $this->sentences = $sentences;
    }

    /**
     * @param Sentence $sentence
     */
    public function save(Sentence $sentence)
    {
        if (!$sentence->save()) {
            throw new RuntimeException('Sentence saving error');
        }
    }

}