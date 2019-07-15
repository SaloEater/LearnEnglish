<?php

namespace common\services;

use common\models\Sentence;
use common\models\Text;

class TextParser
{
    private $wordAPI;
    private $formService;
    private $translationService;
    private $wordService;
    private $formswordsService;
    private $sentenceswordsService;

    private $log;

    public function __construct()
    {
        $this->wordAPI = new WordAPI();
        $this->formService = new FormService();
        $this->translationService = new TranslationService();
        $this->wordService = new WordService();
        $this->formswordsService = new FormsWordsService();
        $this->sentenceswordsService = new SentencesWordsService();
    }

    public function parseTextFromModel(Text $model)
    {
        $this->parseText($model->content, $model->id);
        \Yii::$app->session->setFlash('success', $this->log);
    }

    public function parseText(string $text, int $text_id)
    {
        /**
         * @var string[] $sentences
         */
        preg_match_all('([A-Z]{1}[\w\d\s\-\,\;]+[\.\!]{1})', $text, $sentences);

        foreach ($sentences[0] as $sentence_content) {
            $this->log .= "Sentence: $sentence_content</br>";
            $this->parseSentence($sentence_content, $text_id);
        }
    }

    public function parseSentence(string $sentence_content, int $text_id)
    {
        $model = new Sentence();
        $model->content = $sentence_content;
        $model->text_id=$text_id;
        $model->save();
        /**
         * @var string[] $words
         */
        preg_match_all('(\w+)', $sentence_content, $words);
        foreach ($words[0] as $form_content) {
            $this->log .= "Form: $form_content</br>";
            $this->parseWord($form_content, $model->id);
        }
    }

    public function parseWord(string $form_content, int $sentence_id)
    {
        if (($dict = $this->wordAPI->IsForm($form_content))) {
            $form = $this->formService->getByContent($form_content);
            $form->count++;
            $this->formService->save($form);
            foreach ($dict as $wordContent=>$common) {
                $this->log .= "Word: $wordContent</br>";
                $word = $this->wordService->getByContent($wordContent);
                $this->formswordsService->EstablishLinkBetween($form->id, $word->id);
                $this->sentenceswordsService->EstablishLinkBetween($sentence_id, $word->id);
                foreach ($common as $sort => $description) {
                    $this->log .= "Sort: $sort</br>";
                    $content = $description['tr'];
                    $this->log .= "Content: $content</br>";
                    $type = $description['type'];
                    $this->log .= "Type: $type</br>";
                    $translation = $this->translationService->getByContentAndType($content, $type);
                    $translation->word_id = $word->id;
                    $translation->sort = $sort;
                    $this->translationService->save($translation);
                }
            }
        } else {
            throwException(new \DomainException("Can't reach wordAPI server"));
        }
    }

}