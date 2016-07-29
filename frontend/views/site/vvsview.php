<?php
$this->title = 'VVS View';
$this->params['breadcrumbs'][] = ['label' => 'Hauptmenü', 'url' => ['tiles']];
$this->params['breadcrumbs'][] = ['label' => 'VVS', 'url' => ['vvs']];
$this->params['breadcrumbs'][] = $vvs->name . ' (' . $vvs->direction . ')';
?>

<embed src="media/vvs/<?= $vvs->file_path ?>#toolbar=0&navpanes=0&scrollbar=0" width="100%" height="1200px">