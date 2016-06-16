<?php

use yii\helpers\Html;

echo "<script>console.log('test')</script>";
$this->title = 'Overview';
$this->params['breadcrumbs'][] = $this->title;
?>
<h1>Home</h1>
<?php foreach ($model as $item) { ?>
    <div class="col-sm-6 col-md-3">
        <?=
        Html::a('<img style="width: 100%;" src="data:image;base64,'
                . chunk_split(base64_encode($item->imgdata)) . '"/>', [$item->linkname])
        ?>
    </div>
<?php } ?>
