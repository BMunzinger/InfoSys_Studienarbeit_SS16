<?php
$this->title = 'Personen';
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;

$tileColors = ['blue', 'green', 'red'];
?>
<div id="dozentWrapper">
    <?php
    foreach ($dozents as $dozent) {
        ?>

        <div class="allDozent hidden-sm hidden-xs">
            <div class="thumbnail tile tile-large tile-white" style="height: 100%">
                <?php
                if ($dozent->Picture != NULL) {
                    echo Html::a(''
                            . '<img class="dozentImg" style="height: 80%" src="data:image/png;base64, ' . chunk_split(base64_encode($dozent->Picture)) . '"/>'
                            . '<div class="dozentNameWrapper">'
                            . '<h4 class="dozentName">' . $dozent->Name . ', ' . $dozent->Vorname . ' (' . $dozent->Titel . ')</h4>'
                            . '</div>', ['dozentview', 'id' => $dozent->ID]);
                } else {
                    echo Html::a(''
                            . '<img class="dozentImg" style="height: 80%" src="importantStuff/dummy.jpg">'
                            . '<div class="dozentNameWrapper">'
                            . '<h4 class="dozentName">' . $dozent->Name . ', ' . $dozent->Vorname . ' (' . $dozent->Titel . ')</h4>'
                            . '</div>', ['dozentview', 'id' => $dozent->ID]);
                }
                ?>
            </div>
        </div>
    <?php } ?>
</div>

<?php
foreach ($dozents as $dozent) {
    ?>

    <div class="allDozent hidden-md hidden-lg">
        <div class="thumbnail tile tile-large tile-clouds">
            <?php
            if ($dozent->Picture != NULL) {
                echo Html::a(''
                        . '<img class="dozentImg" style="height: 80%" src="data:image/png;base64, ' . chunk_split(base64_encode($dozent->Picture)) . '"/>'
                        . '<div class="dozentNameWrapper">'
                        . '<h4 class="dozentName">' . $dozent->Name . ', ' . $dozent->Vorname . ' (' . $dozent->Titel . ')</h4>'
                        . '</div>', ['dozentview', 'id' => $dozent->ID]);
            } else {
                echo Html::a(''
                        . '<img class="dozentImg" style="height: 80%" src="importantStuff/dummy.jpg">'
                        . '<div class="dozentNameWrapper">'
                        . '<h4 class="dozentName">' . $dozent->Name . ', ' . $dozent->Vorname . ' (' . $dozent->Titel . ')</h4>'
                        . '</div>', ['dozentview', 'id' => $dozent->ID]);
            }
            ?>
        </div>
    </div>
<?php } ?>

<script>
    function tileOrder() {
        var outerWidth = $('.allDozent > div').outerWidth(true) - $('.allDozent > div').width();
        var tileWidth = $('.allDozent > div').width() + outerWidth;
        var tileNumber = Math.round($('.allDozent').filter(function () {
            return $(this).css('display') === 'block';
        }).length / 2);
        if(tileNumber === 0) {
            tileNumber = 10;
        }

        console.log('outerWidth: ' + outerWidth);
        console.log('tileWidth: ' + tileWidth);
        console.log('tileNumber: ' + tileNumber);

        $('#dozentWrapper').css('width', (tileWidth * tileNumber));
    }

    $(document).ready(function () {
        tileOrder();
    });

</script>
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
        color: black;
    }

    #dozentWrapper {
        position: absolute;
        top: 100px;
    }

    .allDozent > div {
        margin-right: 30px;
        display: inline-block;
    }
    
    .tile.tile-white {
        background-color: #FFF;
    }
    
    .tile.tile-white .dozentName {
        color: #000;
    }
</style>


