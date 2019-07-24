<?php

use common\entities\Text;

$text = Text::findOne(['md5' => 'anchor']);

return [
    [
        'content' => 'This',
        'count' => 1,
        'order' => 6,
    ],
    [
        'content' => 'is',
        'count' => 1,
        'order' => 5,
    ],
    [
        'content' => 'a',
        'count' => 1,
        'order' => 3,
    ],
    [
        'content' => 'another',
        'count' => 1,
        'order' => 4,
    ],
    [
        'content' => 'random',
        'count' => 2,
        'order' => 1,
    ],
    [
        'content' => 'text',
        'count' => 2,
        'order' => 2,
    ],
];
