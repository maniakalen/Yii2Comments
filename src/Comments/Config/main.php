<?php

return [
    'urlRules' => [
        'comments/list/<table>/<id>' => 'comments/api/index',
        'comments/add/<table>/<id>' => 'comments/api/add',
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