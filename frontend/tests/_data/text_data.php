<?php

$user = \common\entities\User::findOne(['username' => 'erau']);

return [
    [
        'content' => 'This is a random text.',
        'md5' => 'anchor',
        'created_by' => $user->id,
        'updated_by' => $user->id,
        'created_at' => 0,
        'updated_at' => 0,
    ],
];
