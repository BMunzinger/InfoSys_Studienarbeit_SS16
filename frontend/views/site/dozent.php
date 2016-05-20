<?php /*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */ ?>

<?php
$tileColors = ['blue', 'green', 'red'];
foreach ($dozents as $dozent) {
    ?>
    <div class="col-md-4">
        <div class="thumbnail tile tile-large tile-clouds">
            <a>
                <img class="dozentImg" style="height: 80%" src="data:image/png;base64, <?= chunk_split(base64_encode($dozent->Picture)) ?> "/>
                
                <div class="dozentNameWrapper">
                    <h4 class="dozentName"><?= $dozent->Titel ?> <?= $dozent->Titel ?> <?= $dozent->Name ?>, <?= $dozent->Vorname ?></h4>
                </div>
            </a>
        </div>
    </div>
<?php } ?>
<style>
    .dozentImg {
        margin-bottom: 4px;
    }
    
    .dozentNameWrapper {
        display: table;
        height: 20%;
        text-align: center;
    }
    
    .dozentName {
        display: table-cell;
        vertical-align: middle;
        line-height: normal; 
        border-top: 1px solid #34495e;
        color: black;
    }
</style>


