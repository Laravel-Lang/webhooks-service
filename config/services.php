<?php

return [

    'telegram' => [
        'token' => env('TELEGRAM_BOT_TOKEN'),

        'chats' => explode(',', env('TELEGRAM_CHATS', ''))
    ],

    'github' => [
        'token' => env('GITHUB_WEBHOOK_TOKEN')
    ],

];
