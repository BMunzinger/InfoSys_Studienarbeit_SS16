<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="imgLeft">
        <img class="" style="height: 80%" src="data:image/png;base64, <?= chunk_split(base64_encode($dozent->Picture)) ?> "/>
    </div>
    <div class="wrapperDozent">
        <h1><?= $dozent->Titel ?> <?= $dozent->Name ?>, <?= $dozent->Vorname ?></h1>
        <h3><?= $dozent->Position ?></h3>
        <hr/>
        <h2>Sprechzeiten: <?= $dozent->Sprechzeiten ?></h2>
        <h2>Raum: <?= $dozent->Raum ?></h2>
        <h2>Telefon: <?= $dozent->Telefon ?></h2>
        <h2>E-Mail: <a href="mailto:<?= $dozent->Email ?>"><?= $dozent->Email ?></a></h2>
    </div>
</div>
<style>
    .row {
        background-color: #ecf0f1;
        border-radius: 5px;
    }
    .imgLeft img{
        border-top-right-radius: 4px;
        float: right;
    }

    .wrapperDozent {
        float: left;
    }

    .wrapperDozent h1,
    .wrapperDozent h2,
    .wrapperDozent h3 {
        padding-left: 12px;
    }

    hr {
        color: #008080;
        background-color: #008080;
        height: 2px;
    }
</style>
