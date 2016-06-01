<?php
$this->title = 'Kursplan';

$this->params['breadcrumbs'][] = $this->title;

foreach ($kursplan as $k) {
    ?>
    <div>
<?= $k->fach['Name'] ?>
    </div>
<?php } ?>

<?= yii2fullcalendar\yii2fullcalendar::widget([
      'options' => [
        'lang' => 'de',
        //... more options to be defined here!
      ],
    'events' => $events,
    ]);
?>

