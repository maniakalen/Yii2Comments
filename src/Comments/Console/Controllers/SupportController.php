<?php

namespace Yii\Modules\Comments\Console\Controllers;

/**
 * Class SupportController
 * @package Yii\Modules\Comments\Console\Controllers
 * @author Petar Ivanov
 * @version 1.0
 */
class SupportController
{
    public function actionAdd($table)
    {
        echo $table;
        \Yii::$app->end();
    }
}