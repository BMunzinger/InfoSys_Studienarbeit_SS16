<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'dist/css/metro-bootstrap.css',
        'Fullcalendar/fullcalendar.css',
        'JQuery UI/jquery-ui.css',
    ];
    public $js = [
        'JQuery UI/jquery-ui.js',
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
