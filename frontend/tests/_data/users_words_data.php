<?php

use common\entities\Word;

$user = \common\entities\User::findOne(['username' => 'erau']);
$user2 = \common\entities\User::findOne(['username' => 'test']);

$word1 = Word::findOne(['content' => 'random']);
$word2 = Word::findOne(['content' => 'text']);
$word3 = Word::findOne(['content' => 'a']);
$word4 = Word::findOne(['content' => 'another']);
$word5 = Word::findOne(['content' => 'is']);
$word6 = Word::findOne(['content' => 'This']);

return [
    [
        'user_id' => $user->id,
        'word_id' => $word6->id,
        'count' => 1,
        'order' => 3,
        'status' => 'none'
    ],
    [
        'user_id' => $user->id,
        'word_id' => $word5->id,
        'count' => 1,
        'order' => 2,
        'status' => 'none'
    ],
    [
        'user_id' => $user->id,
        'word_id' => $word3->id,
        'count' => 1,
        'order' => 1,
        'status' => 'none'
    ],
    [
        'user_id' => $user->id,
        'word_id' => $word1->id,
        'count' => 1,
        'order' => 4,
        'status' => 'none'
    ],
    [
        'user_id' => $user->id,
        'word_id' => $word2->id,
        'count' => 1,
        'order' => 5,
        'status' => 'none'
    ],
    [
        'user_id' => $user2->id,
        'word_id' => $word1->id,
        'count' => 1,
        'order' => 2,
        'status' => 'none'
    ],
    [
        'user_id' => $user2->id,
        'word_id' => $word2->id,
        'count' => 1,
        'order' => 3,
        'status' => 'none'
    ],
    [
        'user_id' => $user2->id,
        'word_id' => $word4->id,
        'count' => 1,
        'order' => 1,
        'status' => 'none'
    ],
];