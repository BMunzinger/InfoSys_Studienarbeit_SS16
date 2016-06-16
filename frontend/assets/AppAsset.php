<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'Metro-Bootstrap/css/metro-bootstrap.css',
        'css/site.css',
        'Fullcalendar/fullcalendar.css',
    ];
    public $js = [
        'Scripts/clock.js',
        'Fullcalendar/lib/moment.min.js',
        'Fullcalendar/fullcalendar.js',
        'Fullcalendar/lang-all.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
