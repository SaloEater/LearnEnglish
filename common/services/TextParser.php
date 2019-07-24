<?php

namespace common\services;

use common\entities\Sentence;
use common\entities\Text;
use common\entities\UsersWords;
use common\helpers\word\WordHelper;
use DomainException;

use Yii;

class TextParser
{
    private $wordAPI;
    private $formService;
    private $translationService;
    private $wordService;
    private $formswordsService;
    private $userswordsService;
    private $sentenceswordsService;
    private $sentenceService;

    private $userID;

    private $log;

    public function __construct(
        FormService $formService,
        TranslationService $translationService,
        WordService $wordService,
        FormsWordsService $formswordsService,
        SentencesWordsService $sentenceswordsService,
        SentenceService $sentenceService,
        UsersWordsService $userswordsService
        )
    {
        $this->wordAPI = new WordAPI();
        $this->formService = $formService;
        $this->translationService = $translationService;
        $this->wordService = $wordService;
        $this->formswordsService = $formswordsService;
        $this->sentenceswordsService = $sentenceswordsService;
        $this->sentenceService = $sentenceService;
        $this->userswordsService = $userswordsService;
    }

    public function parseTextFromModel(Text $model)
    {
        $this->userID = $model->created_by;
        $this->parseText($model->content, $model->id);
        Yii::$app->session->setFlash('success', $this->log);

    }

    public function parseText(string $text, int $text_id)
    {
        /**
         * @var string[] $sentences
         */
        /*
        TODO Может стоит этот ([A-Z][^\.!?]*[\.!?])
        TODO Написать свой парсер предложений
        */
        preg_match_all('([A-Z][\w\d\s\-\,\;]+[\.\!]{1})', $text, $sentences);

        foreach ($sentences[0] as $sentence_content) {
            $this->log .= "Sentence: $sentence_content</br>";
            $this->parseSentence($sentence_content, $text_id);
        }
    }

    public function parseSentence(string $sentence_content, int $text_id)
    {
        $sentence = new Sentence();
        $sentence->content = $sentence_content;
        $sentence->text_id=$text_id;
        $this->sentenceService->save($sentence);
        /**
         * @var string[] $words
         */
        /*
        TODO Старая регулярка (\w+)
        */
        preg_match_all('~\w+|\p{P}~si', $sentence_content, $words);
        foreach ($words[0] as $form_content) {
            $this->log .= "Form: $form_content</br>";
            $this->parseWord($form_content, $sentence->id);
        }
    }

    public function parseWord(string $form_content, int $sentence_id)
    {
        if (WordHelper::isPunctuationMark($form_content)) {
            $word = $this->wordService->getByContent($form_content);
            $this->sentenceswordsService->EstablishLinkBetween($sentence_id, $word->id);
            $this->wordService->save($word, false);
            return;
        }

        if (($dict = $this->wordAPI->IsForm($form_content))) {
            $form = $this->formService->getByContent($form_content);
            $this->formService->save($form);
            foreach ($dict as $wordContent=>$common) {
                $this->log .= "Word: $wordContent</br>";
                $word = $this->wordService->getByContent($wordContent);
                $this->formswordsService->EstablishLinkBetween($form->id, $word->id);
                $this->sentenceswordsService->EstablishLinkBetween($sentence_id, $word->id);
                $this->wordService->save($word);
                $usersWords = $this->userswordsService->getLink($this->userID, $word->id);
                $this->userswordsService->save($usersWords);


                foreach ($common as $sort => $description) {
                    $this->log .= "Sort: $sort</br>";
                    $content = $description['tr'];
                    $this->log .= "Content: $content</br>";
                    $type = $description['type'];
                    $this->log .= "Type: $type</br>";
                    $this->translationService->ensureExists($content, $type, $word->id, $sort);
                }
            }
        } else {
            throw new DomainException("Can't reach wordAPI server");
        }
    }

}