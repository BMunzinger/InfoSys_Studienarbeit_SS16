<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="logo.png" height="60px" style="margin-top: -10px;"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
    $menuItems = [
        ['label'=>'Home', 'url' => ['/site/index']],
        ['label' => 'Übersicht', 'url' => ['/site/tiles']],
        ['label' => 'News', 'url' => ['/site/news']],
        ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav visible-xs'],
        'items' => $menuItems,
        
    ]); 
    echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        'options' => ['class'=> "breadcrumb hidden-xs"],
        ]) 
    ?>
    
        
    <?php 
    setlocale(LC_ALL, "de_DE.utf8");
    $glock = [
        ['label' => strftime('%A')
            .', der '
            .date('d.m.Y H:i')
            .' Uhr.']
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right clock hidden-xs'],
        'items' => ['label' => ''],
 
      
    ]);
    NavBar::end();
    ?>

    <div class="container">
        
        
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
    
    <footer class="footer">
    <div class="container">
         <marquee direction="left" class="newsTicker">www.eKiwi.de</marquee>   
    </div>
</footer>
   
</body>


<style>
    .footer{
        background-color: #222222;
        position:fixed;
        left:0px;
        bottom:0px;
        height:60px;
        width:100%;
    }
    .newsTicker{
        margin: 0;
        padding: 0;
        color: #ffffff;
        font-size: 15px;
    }
    .clock{
        font-size: 30px;
        margin-top: 10px;
        color: #ffffff;
    }
   
    .breadcrumb {background: #222222; display: block; vertical-align: middle; margin-top: 5px;}
    .breadcrumb li {font-size: 20px;}
    .breadcrumb a {color: rgba(66, 139, 202, 1);}
    .breadcrumb a:hover {color: rgba(42, 100, 150, 1);}
    .breadcrumb>.active {color: rgba(153, 153, 153, 1);}
    .breadcrumb>li+li:before {color: rgba(255, 255, 255, 1); content: "\276F\00a0";}
    
    .wrap > .container{
        padding: 100px 15px 20px;
    }
    
    .navbar-toggle{
        margin-top: 17px;
    }
    
    .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
        border-color: #222222;
    }
    
    .navbar-collapse {
        box-shadow: none;
    }

</style>

</html>
<?php $this->endPage() ?>
