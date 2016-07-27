<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\Kursplan;

$this->title = 'Stundenspläne';
?>
<div class="site-index">
    <h1><?= $kurs ?></h1>
    <?php
    $wochentag = ['Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag'];
    $block = ['1. Block', '2. Block', '3. Block', '4. Block', '5. Block', '6. Block'];

    Modal::begin([
        'header' => '<h2>Neuen Kurs erstellen</h2>',
        'toggleButton' => ['label' => 'Neuen Kurs hinzufügen', 'class' => 'btn btn-info'],
    ]);

    $form = ActiveForm::begin([
            ])
    ?>
    <?=
    $form->field($newEntry, 'Dozent')->dropDownList(ArrayHelper::map(common\models\Dozent::find()->all(), 'ID', function($q) {
                return $q->Name . ' ' . $q->Vorname;
            }), ['prompt' => 'Dozent auswählen'])
    ?>
    <?= $form->field($newEntry, 'Fach')->dropDownList(ArrayHelper::map(common\models\Fach::find()->all(), 'ID', 'Name'), ['prompt' => 'Fach auswählen']) ?>
    <?= $form->field($newEntry, 'Raum') ?>
    <?= $form->field($newEntry, 'ZeitVon') ?>
    <?= $form->field($newEntry, 'ZeitBis') ?>
    <?= $form->field($newEntry, 'Wochentag')->dropDownList($wochentag, ['prompt' => 'Wochentag auswählen']) ?>

    <?= Html::submitButton('Speichern', ['class' => 'btn btn-info']) ?>

    <?php
    ActiveForm::end();
    Modal::end();
    ?>
</div>

<?php
foreach ($q as $t) {
    Modal::begin([
        'header' => '<h2>Kurs bearbeiten</h2>',
        'toggleButton' => ['tag' => 'i', 'label' => 'Bearbeiten <i class="glyphicon glyphicon-pencil"></i>', 'id' => 'modal-' . $t->ID, 'style' => 'cursor: pointer'],
    ]);

    ActiveForm::begin(['action' => ['updateevent']]);

    $model = Kursplan::findOne($t->ID);
    echo $form->field($model, 'Dozent')
            ->dropDownList(ArrayHelper::map(common\models\Dozent::find()->all(), 'ID', function($q) {
                        return $q->Name . ' ' . $q->Vorname;
                    }), ['prompt' => 'Dozent auswählen']);
    echo $form->field($model, 'Fach')
            ->dropDownList(ArrayHelper::map(common\models\Fach::find()->all(), 'ID', 'Name'), ['prompt' => 'Fach auswählen']);
    echo $form->field($model, 'Raum');
    echo $form->field($model, 'ZeitVon')
            ->dropDownList($block, ['prompt' => 'Zeit von']);
    echo $form->field($model, 'ZeitBis')
            ->dropDownList($block, ['prompt' => 'Zeit bis']);
    echo $form->field($model, 'Wochentag')
            ->dropDownList($wochentag, ['prompt' => 'Wochentag auswählen']);


    echo Html::submitButton('Speichern', ['class' => 'btn btn-info']);

    echo $form->field($model, 'ID')->hiddenInput()->label(false);
    echo $form->field($model, 'Semester')->hiddenInput()->label(false);

    ActiveForm::end();

    ActiveForm::begin([
        'action' => ['deleteevent']
    ]);
    echo $form->field($model, 'ID')->hiddenInput()->label(false);
    echo $form->field($model, 'Semester')->hiddenInput()->label(false);
    echo Html::submitButton('Löschen', ['data' => ['confirm' => 'Möchten Sie denn Eintrag wirklich löschen?'], 'class' => 'btn btn-info']);
    ActiveForm::end();
    Modal::end();
    ?>

<?php }
?>

<div id = 'calendar'></div>

<div style = 'clear:both'></div>

<script>
    $(document).ready(function () {
        $('#calendar').fullCalendar({
            header: {
                left: '',
                center: '',
                right: ''
            },
            weekends: false,
            lang: 'de',
            defaultView: 'agendaWeek',
            allDaySlot: false,
            axisFormat: 'HH:mm',
            //            slotEventOverlap: false,
            slots: [
                {start: '07:35', end: '09:05'},
                {start: '09:30', end: '11:00'},
                {start: '11:15', end: '12:45'},
                {start: '14:00', end: '15:30'},
                {start: '15:45', end: '17:15'},
                {start: '17:30', end: '19:00'}
            ],
            events: <?php echo json_encode($events) ?>
        });

<?php foreach ($q as $t) { ?>
            $("#modal-" + <?= $t->ID ?>).prependTo(".event-" + <?= $t->ID ?> + " .fc-content");
<?php } ?>

        $('.modal-body input, .modal-body select').prop('required', true);

        $('.modal-body #kursplan-zeitvon').on('change', function () {
            $('.modal-body #kursplan-zeitbis option').show();
            var that = $(this).val();
            $('.modal-body #kursplan-zeitbis option').filter(function () {
                return this.value < that;
            }).hide();
        });
        
        $('.modal-body #kursplan-zeitbis').on('change', function () {
            $('.modal-body #kursplan-zeitbis option').show();
            var that = $(this).val();
            $('.modal-body #kursplan-zeitvon option').filter(function () {
                return this.value > that;
            }).hide();
        });
    });
</script>

<style>
    .fc-content .fc-time{
        display : none;
    }

    .fc-title {
        font-size: 14px;
    }

    .fc-slats tr.fc-major {
        height: 60px;
    }
</style>