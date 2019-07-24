<?php

use common\entities\User;

$user = User::findOne(['username' => 'erau']);
$user2 = User::findOne(['username' => 'test']);

return [
    [
        'content' => 'This is a random text.',
        'md5' => 'anchor',
        'created_by' => $user->id,
        'updated_by' => $user->id,
        'created_at' => 0,
        'updated_at' => 0,
    ],
    [
        'content' => 'Another random text.',
        'md5' => 'anchor2',
        'created_by' => $user2->id,
        'updated_by' => $user2->id,
        'created_at' => 0,
        'updated_at' => 0,
    ],
];
