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
    public $sourcePath = '@Comments/resources';
    public $baseUrl = '@web';
    public $css = [
        'css/comments.css',
    ];
    public $js = [
        'js/handlebars.js',
        'js/init.js',

    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}