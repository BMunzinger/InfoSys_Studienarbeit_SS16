<?php

$this->title = 'VVS View';
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = ['label' => 'VVS', 'url' => ['vvs']];
$this->params['breadcrumbs'][] = $vvs->name . ' (' . $vvs->direction . ')';

$file = 'media/vvs/Linie112.pdf';
$filename = 'Linie.pdf';

?>

<embed src="<?= $vvs->file_path ?>#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="1200px">