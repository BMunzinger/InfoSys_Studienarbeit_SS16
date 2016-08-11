<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use backend\models\NewsrssUpdate;

$this->title = 'News';
?>
<h1>News</h1>
<div class="site-index">
    <?php foreach ($links as $link) { ?>
        <div style="clear: both; margin-bottom: 12px;">
            <?= $link->Description ?>
        </div>
        <div style="width: 100%">
            <?php
            $form = ActiveForm::begin(['id' => 'newsupdate', 'action' => ['newsupdate']]);
            $newsRssUpdate = new NewsrssUpdate();
            ?>
            <div>
                <span>
                    <?= $form->field($newsRssUpdate, 'URL')->textInput(['value' => $link->URL])->label(false) ?>
                </span>
                <span>
                    <button type="submit" method="post" name="editNews" value="editNews" class="btn btn-primary" aria-label="Edit">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
                    </button>
                </span>
                <?= $form->field($newsRssUpdate, 'id')->hiddenInput(['value' => $link->ID])->label(false) ?>
                <?= $form->field($newsRssUpdate, 'Description')->hiddenInput(['value' => $link->Description])->label(false) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    <?php } ?>
</div>
