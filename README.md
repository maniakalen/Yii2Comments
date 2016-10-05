# Yii2Comments

Still in development

The module needs bootstrapping, so we have to add it to the bootstrap list of the configuration.

Supported configuration params for sorting the results and for defining page size when defining the module:
<pre>
  'comments' => [
            'class' => '\Comments\Module',
            'di' => [
                '\Comments\Common\Models\Comments' => [
                    'class' => '\Comments\Common\Models\Comments',
                    'defaultOrder' => ['\Comments\Common\Models\Comments.created_at' => SORT_DESC]
                ],
                '\Comments\Frontend\Controllers\ApiController' => [
                    'class' => '\Comments\Frontend\Controllers\ApiController',
                    'pagination' => ['pageSize' => 2],
                ]
            ]
        ]
</pre>
