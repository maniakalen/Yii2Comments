<?php

return [
    'urlRules' => [
        'comments/list/<table>/<id>' => 'comments/comments/index',
        'comments/add/<table>/<id>' => 'comments/comments/add',
    ],
    'aliases' => [
        '@Yii\Modules\Comments' => '@Comments',
        '@commentsSql' => '@Comments/Console/sql',
    ]
];