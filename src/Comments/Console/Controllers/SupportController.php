<?php

namespace Comments\Console\Controllers;

use yii\console\Controller;

/**
 * Class SupportController
 * @package Yii\Modules\Comments\Console\Controllers
 * @author Petar Ivanov
 * @version 1.0
 */
class SupportController extends Controller
{
    public function actionAdd($table)
    {
        echo $table;
        \Yii::$app->end();
    }
}