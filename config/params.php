<?php

return [
    'adminEmail' => 'admin@example.com',
    'availableLanguage' => [
        'en' => ['en-US', 'English'],
        'zh' => ['zh-CN', '简体中文'],
    ],
    'urlRules' => [
        "^(https://){0,1}item.taobao.com/item.htm\?",
//        "^http(s){0,1}://.+/.+",
    ],
    'urlExamples' => [
        'https://item.taobao.com/item.htm?spm=a230r.1.14.328.QUFKSj&id=535608330129&ns=1&abbucket=8',
    ],

    'usdRate' => '6.5',

    'userCartCookieIdentity' => "_userCartIdentity",

    'paymentType' => [
        'aliPay' => [
            'handingFeeText' => '0.6%',
            'handingFee' => '0.006',
            'subject' => 'ChinaInAir Payment'
        ],
        'payPal' => [
            'handingFeeText' => '3.5% + $0.30',
            'handingFee' => '0.035 + 0.3'
        ]
    ],

    'aliPayApi' => [
        'appPrivateKey' => 'MIICXQIBAAKBgQDFSC/2xL3/g0V2juZ8s9jsYdk7WRe4BiJuFgr9lfprfYJk84jishO5dlND9ddyR5qXDVM1cRqLCamUgduuepEZrMuhbK04n9fy8dJLr+vWCGRfesCDBopobWGrBTLufEUjXybZR+Vtr0dYivb8mlpFM5flAUh6I/xIq46STlufQQIDAQABAoGBAI2Nrlyx7mJYHo9jGZ6ArTVvQB+FXa99N1cmGdy6sGRQOi+VTrLac6yvai9pRp2JIzMfLIU8En+Q/0y/oJEhANrWox3NFE4dSHnOmHrJymgT1btF+Ld5d/jMPsWO3X943iJmyV0NTkcIQt05VjnnUhZmoNP+EwIC/BmLdIANnkLBAkEA/GpJ9lgNwp8FmC2tONmZY4bC5OwIimVyy/W4aTaowROebqJgfdMqxRgbPMcw5GxCJx+WDQ+V1eCuJGLhzgjDRwJBAMgVcxLCxWD5vOGwENIneu7qmFcuH3LqEIXa/v2zM2eWEEelHXeyKVuKaHFbrcKU6pys8uP7kd8lo7hO53PgfTcCQGesqHBcPlqfwkZ9DFb7WTs90LMCF4fwnzQS2wmr/6g+DKbYXtWPdFO70QQntHc91/YFzTXUHvDX9e7QBnr/smUCQQC15aoj2CYQr3njw2jHZVUBdwzf1PKKSfiTeDBw/EUzWt2aBKXxd2rZ6c5hn/Mr/q37mc+HK+HFeDaLDFCmq+OpAkB/uC/W9RJwsrniz0ViAdyX9O+9TzWVR9Z20O25FjQ36EFQuECfC6ym3htkUxRH7SNzrXrBUXTgf8x+YW3DySHF',

        'aliPublicKey' => 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB',

        'environment' => 'sandbox', //sandbox or production
        'signType' => 'RSA',
        'appId' => '2016081900287418',

    ],
];
