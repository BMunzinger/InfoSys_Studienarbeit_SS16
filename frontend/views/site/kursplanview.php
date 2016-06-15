<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'My Yii Application';
foreach ($kursplan as $k) {
    ?>
    <div class="col-sm-6 col-md-4">
        <?=
        Html::a('<div class="thumbnail tile tile-wide tile-teal">'
                . '<h1>' . $k->Semester . '</h1>'
                . '</div>', ['kursplan', 'kurs' => $k->Semester])
        ?>
    </div>
<?php }
?>