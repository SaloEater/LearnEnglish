<?php

$text = \common\entities\Text::findOne(['md5' => 'anchor']);

return [
    [
        'content' => 'This is a random text.',
        'text_id' => $text->id
    ],
];
