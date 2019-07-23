<?php

$text = \common\entities\Text::findOne(['md5' => 'anchor']);
$text2 = \common\entities\Text::findOne(['md5' => 'anchor2']);

return [
    [
        'content' => 'This is a random text.',
        'text_id' => $text->id
    ],
    [
        'content' => 'Another random text.',
        'text_id' => $text2->id
    ],
];
