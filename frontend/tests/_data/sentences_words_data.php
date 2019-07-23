<?php

use common\entities\Word;

$text = \common\entities\Text::findOne(['md5' => 'anchor']);
$text2 = \common\entities\Text::findOne(['md5' => 'anchor2']);

$sentence = \common\entities\Sentence::findOne(['text_id' => $text->id]);
$sentence2 = \common\entities\Sentence::findOne(['text_id' => $text2->id]);

$word1 = Word::findOne(['content' => 'random']);
$word2 = Word::findOne(['content' => 'text']);
$word3 = Word::findOne(['content' => 'a']);
$word4 = Word::findOne(['content' => 'another']);
$word5 = Word::findOne(['content' => 'is']);
$word6 = Word::findOne(['content' => 'This']);

return [
    [
        'sentence_id' => $sentence->id,
        'word_id' => $word6->id,
    ],
    [
        'sentence_id' => $sentence->id,
        'word_id' => $word5->id,
    ],
    [
        'sentence_id' => $sentence->id,
        'word_id' => $word3->id,
    ],
    [
        'sentence_id' => $sentence->id,
        'word_id' => $word1->id,
    ],
    [
        'sentence_id' => $sentence->id,
        'word_id' => $word2->id,
    ],
    [
        'sentence_id' => $sentence2->id,
        'word_id' => $word4->id,
    ],
    [
        'sentence_id' => $sentence2->id,
        'word_id' => $word1->id,
    ],
    [
        'sentence_id' => $sentence2->id,
        'word_id' => $word2->id,
    ],
];
