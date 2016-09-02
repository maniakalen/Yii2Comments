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
        $schema = $this->_getDbSchema();
        if ($schema) {
            $tableDesc = \Yii::$app->getDb()->createCommand("SELECT COLUMN_TYPE FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '$schema' AND TABLE_NAME = 'comments' AND COLUMN_NAME = 'table_relation' LIMIT 1")->queryOne();
            if (!$tableDesc) {
                $this->stderr("Module not initalized");
            } else {
                if (stripos($tableDesc['COLUMN_TYPE'], 'ENUM') !== false && preg_match_all("@'(.*)'@iU", $tableDesc['COLUMN_TYPE'], $matches) && !in_array($table, $matches[1])) {
                    $null = array_search(null, $matches[1]);
                    if ($null !== false) {
                        if (is_array($null)) {
                            foreach ($null as $n) unset($matches[1][$n]);
                        } else if (is_numeric($null)) {
                            unset($matches[1][$null]);
                        }
                    }
                    $matches[1][] = $table;
                    $sql = sprintf("ALTER TABLE comments CHANGE COLUMN table_relation table_relation ENUM('%s') CHARACTER SET 'utf8' NULL DEFAULT NULL", implode("','", $matches[1]));
                    try {
                        \Yii::$app->getDb()->createCommand($sql)->execute();
                        $this->stdout("Support for $table added successfuly");
                    } catch (\Exception $ex) {
                        $this->stderr("Failed to add support for $table");
                    }
                } else {
                    $this->stdout("Table already supported");
                }
            }
        }
        \Yii::$app->end();
    }

    public function actionInit()
    {

        $schema = $this->_getDbSchema();
        if ($schema) {
            $table = \Yii::$app->getDb()->createCommand("SELECT * FROM information_schema.TABLES WHERE TABLE_SCHEMA = '$schema' AND TABLE_NAME = 'comments' LIMIT 1")->queryOne();
            if (!$table) {
                $path = \Yii::getAlias('@commentsSql/create.sql');
                if (file_exists($path)) {
                    $sql = file_get_contents($path);
                    try {
                        \Yii::$app->getDb()->createCommand($sql)->execute();
                        $this->stdout("Table created successfully");
                    } catch (\Exception $e) {
                        $this->stderr("Failed to initialize module");
                    }
                } else {
                    $this->stderr("Unable to find file in $path");
                }
            } else {
                $this->stdout("Table already exists");
            }
        }
    }

    private function _getDbSchema()
    {
        $schema = \Yii::$app->getDb()->dsn;

        if (preg_match('/^.*;dbname=(.*)$/',$schema,$matches)) {
            return $matches[1];
        }
        return null;
    }
}