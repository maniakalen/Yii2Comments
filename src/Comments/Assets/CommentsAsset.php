<?php
/** $Id: - $ */
/**
 * ---------  Begin Version Control Data----------------------------------------
 * $LastChangedDate: - $
 * $Revision: - $
 * $LastChangedBy: - $
 * $Author: - $
 * ---------  End Version Control Data -----------------------------------------
 */
namespace Comments\Assets;

use yii\web\AssetBundle;

class CommentsAsset extends AssetBundle
{
    public $basePath = '@comments/resources';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/handlebars.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}