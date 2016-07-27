<?php
$this->title = 'Dozenten';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;

$tileColors = ['blue', 'green', 'red'];
foreach ($dozents as $dozent) {
    ?>
    <div class="col-md-4">
        <div class="thumbnail tile tile-large tile-clouds">
            <?=
            Html::a(''
                    . '<img class="dozentImg" style="height: 80%" src="data:image/png;base64, ' . chunk_split(base64_encode($dozent->Picture)) . '"/>'
                    . '<div class="dozentNameWrapper">'
                    . '<h4 class="dozentName">' . $dozent->Titel . '' . $dozent->Name . ', ' . $dozent->Vorname . '</h4>'
                    . '</div>', ['dozentview', 'id' => $dozent->ID])
            ?>
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
        width: 100%;
    }

    .dozentName {
        display: table-cell;
        vertical-align: middle;
        line-height: normal; 
        border-top: 1px solid #34495e;
        color: black;
    }
</style>


