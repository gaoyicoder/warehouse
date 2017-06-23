<?php

return [
    'adminEmail' => 'admin@example.com',
    'availableLanguage' => [
        'en' => ['en-US', 'English'],
        'zh' => ['zh-CN', '简体中文'],
    ],
    'urlRules' => [
        "^(https://){0,1}item.taobao.com/item.htm\?",
        "^(https://){0,1}detail.tmall.com/item.htm\?",
    ],
    'urlExamples' => [
        'https://item.taobao.com/item.htm?spm=a230r.1.14.328.QUFKSj&id=535608330129&ns=1&abbucket=8',
        'https://detail.tmall.com/item.htm?spm=a1z10.5-b-s.w4011-14969233865.49.96nZmK&id=40233417741&rn=382a6b39f05d2373554c581fe0210fb0&abbucket=5&skuId=3424375210229',
    ],
];
