<?php
$this->title = 'VVS View';
$this->params['breadcrumbs'][] = ['label' => 'VVS', 'url' => ['vvs']];
$this->params['breadcrumbs'][] = $this->title;
?>
<embed src="<?= $vvs->file_path . $vvs->name ?>.pdf" width="100%" height="2000px">