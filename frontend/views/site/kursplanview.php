<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Stundenplan';
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="content">
    <div class="filterTile">
        <h3>
            <a class='semester'>Alle</a>
            <a>1. Semester</a>
            <a>2. Semester</a>
            <a>3. Semester</a>
            <a>4. Semester</a>
            <a>5. Semester</a>
            <a>6. Semester</a>
            <a>7. Semester</a>
        </h3>
    </div>
    <div id="tileWrapper">
        <?php
        foreach ($kursplan as $k) {
            preg_match("/\d+/", $k->Semester, $semester);
            ?>
            <div class='allSemester semester<?= $semester[0] ?> hidden-sm hidden-xs'>
                <?=
                Html::a('<div class="thumbnail tile tile-wide tile-teal">'
                        . '<h1>' . $k->Semester . '</h1>'
                        . '</div>', ['kursplan', 'kurs' => $k->Semester])
                ?>
            </div>
        <?php }
        ?>

    </div>
    <div id="semesterWrapper">
        <?php
        foreach ($kursplan as $k) {
            preg_match("/\d+/", $k->Semester, $semester);
            ?>
            <div class='allSemester semester<?= $semester[0] ?> hidden-md hidden-lg col-sm-6'>
                <?=
                Html::a('<div class="thumbnail tile tile-wide tile-teal">'
                        . '<h1>' . $k->Semester . '</h1>'
                        . '</div>', ['kursplan', 'kurs' => $k->Semester])
                ?>
            </div>
        <?php }
        ?>
    </div>
</div>
<script>
    function tileOrder() {
        var outerWidth = $('.allSemester a div').outerWidth(true) - $('.allSemester a div').width();
        var tileWidth = $('.allSemester a div').width() + outerWidth;
        var tileNumber = Math.round($('.allSemester').filter(function () {
            return $(this).css('display') === 'block';
        }).length / 2);
        $('#tileWrapper').css('width', (tileWidth * tileNumber));
    }

    $(document).ready(function () {
        $('.filterTile a').click(function () {
            $('.filterTile a').removeClass('semester');
            $(this).addClass('semester');
            var val = $(this).text().charAt(0);
            if ($.isNumeric(val)) {
                $('.filterTile').closest('#content').find('#tileWrapper .allSemester').hide();
                $('.filterTile').closest('#content').find('#tileWrapper .semester' + val).show();
            } else {
                $('.filterTile').closest('#content').find('#tileWrapper .allSemester').show();
            }
            tileOrder();
        });
        tileOrder();
    });

</script>

<style>
    .filterTile {
        margin-bottom: 25px;   
        top: 100px;
    }

    .filterTile a {
        padding-right: 15px;
        color: black;
        cursor: pointer;
    }

    #tileWrapper {
        position: absolute;
        top: 200px;
    }

    .allSemester a div {
        margin-right: 30px;
        display: inline-block;
    }

    .semester {
        font-weight: bold;
    }

    .filterTile a:hover {
        color: blue;
        text-decoration: none;
    }

    #semesterWrapper {
        position: absolute;
        top: 200px;
    }

    @media(min-width:767px) {
        .filterTile {
            position: fixed;
        }
    }

    @media(max-width:415px) {
        #semesterWrapper {
            top: 250px;
        }
    }
</style>