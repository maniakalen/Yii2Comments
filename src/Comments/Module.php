<?php

namespace Comments;

use Comments\Common\Models\Comments;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\helpers\ArrayHelper;

/**
 * Class Module
 * @package Yii\Modules\Comments
 * @author Petar Ivanov
 * @version 1.0.0
 */
class Module extends \yii\base\Module implements BootstrapInterface
{
    public $urlRules;
    public $configs;
    public $di;
    public function init()
    {
        parent::init();

        Yii::setAlias('@Comments', realpath(dirname(__FILE__)));

        Yii::configure(
            $this,
            ArrayHelper::merge(
                include \Yii::getAlias('@Comments/Config/main.php'),
                include \Yii::getAlias('@Comments/Config/components.php')
            )
        );

        Yii::$app->getI18n()->translations['comments'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => Yii::$app->sourceLanguage,
            'basePath' => '@Comments/resources/messages',
        ];
        if (!empty($this->di)) {
            foreach ($this->di as $class => $definition) {
                $params = [];
                if (isset($definition['params'])) {
                    $params = $definition['params'];
                    unset($definition['params']);
                }
                \Yii::$container->set($class, $definition, $params);
            }
        }
        if (!empty($this->configs)) {
            foreach ($this->configs as $component => $config) {
                $component = Yii::$app->get($component);
                if ($component instanceof Component) {
                    if (is_array($config)) {
                        foreach ($config as $param => $values) {
                            if (is_array($values)) {
                                $component->$param = ArrayHelper::merge($component->$param, $values);
                            } else {
                                $component->$param = $values;
                            }
                        }
                    }
                }
            }
        }
    }
    /**
     * Bootstrap method to be called during application bootstrap stage.
     *
     * @param Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\web\Application) {
            $this->controllerNamespace = 'Comments\Frontend\Controllers';
            if (is_array($this->urlRules) && !empty($this->urlRules)) {
                $app->getUrlManager()->addRules($this->urlRules);
            }

            $model = \Yii::createObject(Comments::className());
            $order = reset($model->defaultOrder);
            \Yii::$app->getView()->registerJs('
                yii = yii || {"comments" : {}}; 
                yii.comments = yii.comments || {"data" : []};
                yii.comments.order = ' . $order . '
            ');
        }
        if ($app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'Comments\Console\Controllers';
        }
    }
}