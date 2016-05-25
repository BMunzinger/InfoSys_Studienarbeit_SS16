<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'My Yii Application';

foreach ($items as $item) {
    ?>
    <div class="col-sm-6 col-md-4">
        <?=
        Html::a('<div class="thumbnail tile tile-wide tile-teal">'
                . '<h1>' . $item->name . '</h1>'
                . '</div>', [$item->linkname])
        ?>
    </div>
<?php }
?>
