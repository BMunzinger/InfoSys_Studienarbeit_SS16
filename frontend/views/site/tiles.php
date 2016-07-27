<?php

use yii\helpers\Html;
$this->title = 'Overview';
$this->params['breadcrumbs'][] = $this->title;

foreach ($model as $item) {
?>
    <div class="col-xs-6 col-md-3" style="margin-bottom: 20px">
        <?=
        Html::a('<img style="width: 100%;" src="data:image;base64,'
                . chunk_split(base64_encode($item->imgdata)) . '"/>', [$item->linkname])
        ?>
    </div>
<?php }
?>
