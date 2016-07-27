<?php
$this->title = 'Personenansicht';
$this->params['breadcrumbs'][] = ['label' => 'Dozenten', 'url' => ['dozent']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">

        <img class="pictureDozent" src="data:image/png;base64, <?= chunk_split(base64_encode($dozent->Picture)) ?> "/>

    <div class="wrapperDozent">
        <h1><?= $dozent->Titel ?> <?= $dozent->Name ?>, <?= $dozent->Vorname ?></h1>
        <h3><?= $dozent->Position ?></h3>
        <hr/>
        <h2>Sprechzeiten: <?= $dozent->Sprechzeiten ?></h2>
        <h2>Raum: <?= $dozent->Raum ?></h2>
        <h2>Telefon: <?= $dozent->Telefon ?></h2>
        <h2>E-Mail: <a href="mailto:<?= $dozent->Email ?>"><?= $dozent->Email ?></a></h2>
    </div>

<!--<table>
    <tr>
    <h1><?= $dozent->Titel ?> <?= $dozent->Name ?>, <?= $dozent->Vorname ?></h1>
    </tr>
    <tr>
        <h3><?= $dozent->Position ?></h3>
    </tr>
</table>-->
    
</div>
<style>
    .pictureDozent{
        max-width: 50%;
        padding: 12px;
        float: right;
    }
    
    @media(max-width:767px) {
        
    body{
        font-size: 10px;
    }
    
    .pictureDozent{
        max-width: 50%;
        padding: 12px;
        float: none;
    }
    }
    
    
    .row {
        background-color: #ecf0f1;
    }
    .imgLeft img{
        border-top-right-radius: 4.5px;
        float: right;
    }

    .wrapperDozent h1{
        //float: left;
        font-size: 250%;
    }
    
    .wrapperDozent h3{
        font-size: 200%;
        
    }
    
    .wrapperDozent h2{
        font-size: 220%;
        
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
