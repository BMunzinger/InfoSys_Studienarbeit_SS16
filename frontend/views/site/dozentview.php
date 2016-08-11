<?php
$this->title = 'Personenansicht';
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = ['label' => 'Personen', 'url' => ['dozent']];
$this->params['breadcrumbs'][] = $dozent->Name . ', ' . $dozent->Vorname;
?>
<div class="row">

    <?php
    if ($dozent->Picture != NULL) {
        ?>
        <img class="pictureDozent" src="data:image/png;base64, <?= chunk_split(base64_encode($dozent->Picture)) ?> "/>
        <?php
    } else {
        ?>
        <img class="pictureDozent" src="importantStuff/dummy.jpg"/>
        <?php
    }
    ?>
    <div class="wrapperDozent">
        <h1><?= $dozent->Name ?>, <?= $dozent->Vorname ?> (<?= $dozent->Titel ?>)</h1>
        <h3><?= $dozent->Position ?></h3>
        <hr/>
        <h2>Sprechzeiten: <?= $dozent->Sprechzeiten ?></h2>
        <h2>Raum: <?= $dozent->Raum ?></h2>
        <h2>Telefon: <?= $dozent->Telefon ?></h2>
        <h2>E-Mail: <?= $dozent->Email ?></h2>
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
        background-color: #fff;
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
