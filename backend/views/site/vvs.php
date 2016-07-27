<?php
/* @var $this yii\web\View */

$this->title = 'VVS';

use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use backend\models\Vvsform;
?>
<div class="site-index">
    <h1>Fahrpläne</h1>
</div>

<table class="table" style="width: 100%;">
    <tr>
        <th>Linie</th>
        <th>Fahrtrichtung</th>
        <th>Datei</th>
        <th colspan="2">Options</th>
    </tr>
    <?php foreach ($items as $item) { ?>
        <?php $form = ActiveForm::begin(['action' => ['vvsedit']], ['options' => ['enctype' => 'multipart/form-data']]); ?>
        <tr>
            <td>
                <?= $form->field($item, 'name')->textInput(['value' => $item->name])->label(false) ?>
            </td>
            <td>
                <?= $form->field($item, 'direction')->textInput(['value' => $item->direction])->label(false) ?>
            </td>
            <td>
                <?= $form->field($newEntry, 'file_path')->fileInput()->label(false) ?>
            </td>
            <td width="1%">
                <?= Html::submitButton('Bearbeiten', ['class' => 'btn btn-success']); ?>
            </td>
            <?php
            echo $form->field($item, 'id')->hiddenInput(['value' => $item->id])->label(false);
            ActiveForm::end();
            ?>
            <td>
                <?php
                $form = ActiveForm::begin(['action' => ['vvsdelete']]);
                echo Html::submitButton('Löschen', ['data' => ['confirm' => 'Möchten Sie denn Eintrag wirklich löschen?'], 'class' => 'btn btn-danger']);
                echo $form->field($item, 'id')->hiddenInput(['value' => $item->id])->label(false);
                ?>
            </td>
        </tr><?php
        ActiveForm::end();
    }
    $form = ActiveForm::begin(['action' => ['vvsupload']], ['options' => ['enctype' => 'multipart/form-data']]);
    ?>
    <tr>
        <td><?= $form->field($newEntry, 'file_path')->fileInput()->label(false) ?>
            <?= Html::submitButton('Erstellen', ['class' => 'btn btn-success']);
            ?>
        </td>
        <?php
        ActiveForm::end();

        $form = ActiveForm::begin(['action' => ['vvsadd']]);
        $addEntry = new Vvsform();
        ?>

        <td><?= $form->field($addEntry, 'name')->textInput(['placeholder' => 'Name'])->label(false) ?></td>
        <td><?= $form->field($addEntry, 'direction')->textInput(['placeholder' => 'Fahrtrichtung'])->label(false) ?></td>
        <td colspan="2">
            <?= Html::submitButton('Erstellen', ['class' => 'btn btn-success']);
            ?>
        </td>
    </tr>
    <?php
    ActiveForm::end();
    ?>
</table>
