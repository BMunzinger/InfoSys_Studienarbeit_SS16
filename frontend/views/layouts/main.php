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
                ['label' => strftime('%A')
                    . ', der '
                    . date('d.m.Y H:i')
                    . ' Uhr.']
            ];
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right clock'],
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
                <marquee direction="left" class="newsTicker">Hitzefrei, alle Vorlesungen entfallen. *** Professor Schmidt ist am Mittwoch nicht im Haus, Sprechstunde entfällt</marquee>   
            </div>
        </footer>

    </body>


    <style>
        .footer{
            background-color: #222222;
            bottom: 0;
            width: 100%;
            position: fixed;
            z-index: 1;
        }
        .newsTicker{
            margin: 0;
            padding: 0;
            color: #ffffff;
            font-size: 15px;
        }
        .clock{
            font-size: 20px;
            margin-top: 10px;
            color: #ffffff;
        }
    </style>

</html>
<?php $this->endPage() ?>
