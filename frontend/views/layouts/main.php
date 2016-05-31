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
        'brandLabel' => '<img src="logo.png" height="40px" style="margin-top: -10px;"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    
//    $menuItems = [
//        ['label'=>'Home', 'url' => ['/site/index']],
//        ['label' => 'Back', 'url' => Yii::$app->request->referrer],
//        ];
//    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav'],
//        'items' => $menuItems,
//        
//    ]); 
    echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) 
    ?>
    
        
    <?php 
    setlocale(LC_ALL, "de_DE.utf8");
    $glock = [
        ['label' => strftime('%A, %e.%B %Y %H:%M')]
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $glock,
      
    ]);
    NavBar::end();
    ?>

    <div class="container">
        
        
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
