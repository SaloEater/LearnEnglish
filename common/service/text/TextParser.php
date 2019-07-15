<?php

namespace common\service\text;

use common\models\Sentence;
use common\models\SentencesWords;
use common\models\Word;
use common\models\Text;
use common\models\Form;
use common\service\word\WordAPI;

class TextParser
{
    private $wordAPI;

    private $log;

    public function __construct()
    {
        $this->wordAPI = new WordAPI();
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
        foreach ($words[0] as $word_content) {

            $this->log .= "Word: $word_content</br>";
            $this->parseWord($word_content, $model->id);
        }
    }

    public function parseWord(string $word_content, int $sentence_id)
    {
        $wordForm = null;
        $word = null;
        if (($lemma = $this->wordAPI->IsForm($word_content))) {
            $wordForm = Form::findOne(['content' => $word_content]);
            if ($wordForm) {
                $word = $wordForm->word;
            } else {
                $wordForm = new Form();
                $wordForm->content = $word_content;
            }
        } else {
            $lemma = $word_content;
        }
        if (!$word) {
            $word = Word::findOne(['content'=>$lemma]);
            if (!$word) {
                $word = new Word();
                $word->content = $lemma;
            }
        }
        $this->log .= "Word form: $word_content</br>";
        $this->log .= "Word lemma: $lemma</br>";
        $word->count++;
        $word->save();
        if ($wordForm && !$wordForm->id) {
            $wordForm->word_id = $word->id;
            $wordForm->save();
        }
        $this->createLinkBetweenWordAndSentence($word->id, $sentence_id);
    }

    private function createLinkBetweenWordAndSentence(int $word_id, int $sentence_id)
    {
        $sentence_word = new SentencesWords();
        $sentence_word->sentence_id = $sentence_id;
        $sentence_word->word_id = $word_id;
        $sentence_word->save();
    }

}