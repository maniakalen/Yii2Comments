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

    public function actionInit()
    {
        $schema = \Yii::$app->getDb()->dsn;

        if (preg_match('/^.*;dbname=(.*)$/',$schema,$matches)) {
            $schema = $matches[1];

            $table = \Yii::$app->getDb()->createCommand("SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$schema' AND TABLE_NAME = 'comments' LIMIT 1")->queryOne();
            if (!$table) {
                $path = \Yii::getAlias('@commentsSql/create.sql');
                if (file_exists($path)) {
                    $pwd = \Yii::$app->getDb()->password;
                    $usr = \Yii::$app->getDb()->username;
                    exec(escapeshellcmd("mysql -u$usr -p$pwd $schema < $path"));
                    $this->stdout("Table created successfully");
                } else {
                    $this->stderr("Unable to find file in $path");
                }
            } else {
                $this->stdout("Table already exists");
            }
        }
    }
}