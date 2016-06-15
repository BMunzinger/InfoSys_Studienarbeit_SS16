<?php

use yii\helpers\Html;

$this->title = 'Willkommen';
?>
<div class="site-welcome">
    <h1>Willkommen in der Fakultät Informationstechnik!</h1>
    <h2>Daily News:</h2>



    <?php
    date_default_timezone_set('UTC');
    foreach ($model as $item) {
        //var_dump($item); die();
        if ($item->day == date("Y-m-j")) {
            ?>
            <div class="col-sm-12 news">
                <div><?= $item->day ?> </div> 
                <div> <?= $item->message ?></div>
            </div>
        <?php
        }
    }
    ?>

    <?=
    Html::a('Hauptmenü', ['tiles']);
    ?>
</div>

<style>
    .tile-news{
        width: 100%;
        height: 10%;
        color: white;
        background-color: #34495e;
    }
    .tile-home{
        padding: 10px;
    }
    .site-news .site-welcome{
        padding-left: 0px !important;
        padding-right: 0px !important;
    }
    .news{
        padding: 0;
        font-size: 15px;
    }
</style>