<?php

use yii\helpers\Html;
use yii\bootstrap\Button;

$this->title = 'Startseite';

?>
<div class="site-welcome">
    <h1>Willkommen in der Fakultät Informationstechnik!</h1>
    
    <?php
    date_default_timezone_set('UTC');
    foreach ($model as $item) {
        //var_dump($item); die();
        if ($item->day == date("Y-m-j")) {
            echo "<h2>Daily News:</h2>";
            break;
        }
    }
    ?>
    
    <?php
    date_default_timezone_set('UTC');
    foreach ($model as $item) {
        //var_dump($item); die();
        if ($item->day == date("Y-m-j")) {
            ?>
            <div class="col-sm-12 thumbnail tile-news tile-info">
<!--                <div><?= $item->day ?> </div> -->
                <div> <?= $item->message ?></div>
            </div>
        <?php
        }
    }
    ?>
    <br/>
    <br/>
    <?=
    Html::a('Weiter ins Hauptmenü >>', ['tiles'], ['id'=>'buttonMainmenu', 'class'=>'btn-xlg btn-danger']);
    ?>
</div>

<style>
    .tile-news{
        width: 100%;
        height: 10%;
        color: white;
        background-color: #34495e;
        font-size: 20px;
        padding: 5px;
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
    
    .site-welcome > h1{
        text-align: center;
    }
    
    .site-welcome a:hover{
        text-decoration: none;
    }
    
    #buttonMainmenu{
        display: table; margin: 0 auto;
    }
    
    .btn-xlg {
    
    padding: 18px 28px;
    font-size: 22px;
    line-height: normal;
    }
</style>