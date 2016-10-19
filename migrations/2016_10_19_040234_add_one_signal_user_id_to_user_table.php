<?php

use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'is_spam' => ['boolean', 'default' => 0]
]);