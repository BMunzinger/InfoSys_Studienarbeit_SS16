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
Modal::begin([
'header' => '<h2>Neuen Kurs erstellen</h2>',
 'toggleButton' => ['label' => 'Neuen Kurs hinzufügen', 'class' => 'btn btn-info'],
]);


$form = ActiveForm::begin([
]);

echo $form->field($newEntry, 'Semester');

echo Html::submitButton('Speichern', ['class' => 'btn btn-info']);


ActiveForm::end();
Modal::end();

foreach ($kursplan as $k) {
preg_match("/\d+/", $k->Semester, $semester);
?>

<div class='allSemester semester<?= $semester[0] ?>'>
    <?=
    Html::a('<div class="btn btn-info col-md-1" style="margin: 8px 8px 8px 0;">' . $k->Semester . '</div>', ['timetable', 'kurs' => $k->Semester])
    ?>
</div>
<?php }
?>

