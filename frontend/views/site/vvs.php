<?php
$this->title = 'VVS';
$this->params['breadcrumbs'][] = $this->title;
use yii\helpers\Html;

foreach ($items as $item) {
    ?>
    <div class="col-md-4">
        <?=
        Html::a('<div class="thumbnail tile tile-wide tile-teal">'
                . '<h1 class="dozentName">' . ucwords($item->name) . '</h1><h2>(' . ucwords($item->direction) . ')</h2></div>'
                , ['vvsview', 'id' => $item->id])
        ?>
    </div>
<?php }
?>

<!--<style>
    .imgWrapper {
        position: relative;
    }

    .timetableImg {
        width: 100%;
        display: none;
        top:50px;
        position: absolute;
    }
</style>

<script>
    $('.btnTimetable').click(function () {
//        $('.btnTimetable').find("i").removeClass("fa-eye-slash").addClass("fa-eye");
//        $(this).find("i").removeClass("fa-eye").addClass("fa-eye-slash");

        $(".timetableImg").css("display", "none");
        $(this).closest('.timetableWrapper').find(".imgWrapper .timetableImg").css("display", "block");
    });
</script>-->