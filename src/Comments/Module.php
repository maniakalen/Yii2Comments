<?php

namespace Yii\Modules\Comments;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 * @package Yii\Modules\Comments
 * @author Petar Ivanov
 * @version 1.0.0
 */
class Module extends \yii\base\Module implements BootstrapInterface
{

    public function init()
    {
        parent::init();

        Yii::setAlias('@comments', realpath(dirname(__FILE__)));

        Yii::configure(
            $this,
            ArrayHelper::merge(
                include \Yii::getAlias('@comments/Config/main.php'),
                include \Yii::getAlias('@comments/Config/components.php')
            )
        );
    }
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            if (is_array($this->urlRules) && !empty($this->urlRules)) {
                $app->getUrlManager()->addRules($this->urlRules);
            }
        }
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'Yii\Modules\Comments\Console\Controllers';
        }
    }
}