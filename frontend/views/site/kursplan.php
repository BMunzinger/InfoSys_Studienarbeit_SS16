<?php
//use yii\widgets\yii2fullcalendar;

$this->title = $kurs;
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = ['label' => 'Stundenplan', 'url' => ['kursplanview']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 id="kursHeader"><?= $kurs ?></h1>
<div id="calendar"></div>

<script>
    $(document).ready(function () {
        var View = 'agendaWeek';
        var center = '';

        if ($(window).width() <= 767) {
            View = 'agendaDay';
            center = 'today prev, next';
        }

        $('#calendar').fullCalendar({
            header: {
                left: '',
                center: center,
                right: ''
            },
            weekends: false,
            lang: 'de',
            defaultView: View,
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
        
        if ($(window).width() <= 767) {
            $('.fc-today-button, .fc-prev-button, .fc-next-button').addClass('btn btn-primary');
            $('.fc-today-button, .fc-prev-button, .fc-next-button').removeClass('fc-state-default');
        }
    });
</script>

<style>
    .fc-content .fc-time{
        display : none;
    }

    .fc-title {
        font-size: 18px;
    }
    
    @media(max-width:767px) {
        #kursHeader {
            text-align: center;
        }
    }
</style>