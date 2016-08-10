<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;

$this->title = 'Stundenspläne';
?>
<div class="site-index">
    <h1>Stundenpläne</h1>
</div>

<?php

$semester = ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7];

Modal::begin([
    'header' => '<h2>Neuen Semester erstellen</h2>',
    'toggleButton' => ['label' => '<i class="glyphicon glyphicon-plus"></i> Neuen Semester hinzufügen', 'class' => 'btn btn-primary'],
]);


$form = ActiveForm::begin([
        ]);


echo $form->field($newEntry, 'Semester')->label('Semesterbezeichnung');
echo Html::radioList('Semester', 1, $semester);

echo Html::submitButton('Speichern', ['class' => 'btn btn-info']);


ActiveForm::end();
Modal::end();

foreach ($kursplan as $k) {
    preg_match("/\d+/", $k->Semester, $semester);
    ?>

    <div class='allSemester semester<?= $semester[0] ?>'>
        <?=
        Html::a('<div class="btn btn-info col-md-1">' . $k->Semester . '</div>', ['timetable', 'kurs' => $k->Semester])
        ?>
    </div>
<?php }
?>

<style>
    .allSemester div {
        margin: 8px 8px 8px 0;
    }
</style>

