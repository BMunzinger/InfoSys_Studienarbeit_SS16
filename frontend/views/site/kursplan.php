<?php
//use yii\widgets\yii2fullcalendar;

$this->title = $kurs;
$this->params['breadcrumbs'][] = ['label' => 'Stundenplan', 'url' => ['kursplanview']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $kurs ?></h1>
<div id="calendar"></div>

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
    });
</script>

<style>
    .fc-content .fc-time{
        display : none;
    }

    .fc-title {
        font-size: 18px;
    }
</style>