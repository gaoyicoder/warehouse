<?php

return [
    'adminEmail' => 'admin@example.com',
    'availableLanguage' => [
        'en' => ['en-US', 'English'],
        'zh' => ['zh-CN', '简体中文'],
    ],
    'urlRules' => [
        "^(https://){0,1}item.taobao.com/item.htm\?",
        "^http(s){0,1}://.+/.+",
    ],
    'urlExamples' => [
        'https://item.taobao.com/item.htm?spm=a230r.1.14.328.QUFKSj&id=535608330129&ns=1&abbucket=8',
    ],

    'usdRate' => '6.5',

    'userCartCookieIdentity' => "_userCartIdentity",
];
