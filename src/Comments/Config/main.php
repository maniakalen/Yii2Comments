<?php

return [
    'urlRules' => [
        'comments/list/<table>/<id>' => 'comments/api/index',
        'comments/add' => 'comments/api/create',
    ],
    'aliases' => [
        '@Yii\Modules\Comments' => '@Comments',
        '@commentsSql' => '@Comments/Console/sql',
    ],
    'configs' => [
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ]
    ]
];