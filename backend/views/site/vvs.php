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
        <th colspan="2">Optionen</th>
    </tr>
    <?php
    $form = ActiveForm::begin(['action' => ['vvsadd'], 'options' => ['enctype' => 'multipart/form-data']]);
    ?>
    <tr>
        <td><?= $form->field($newEntry, 'name')->textInput(['placeholder' => 'Name'])->label(false) ?></td>
        <td><?= $form->field($newEntry, 'direction')->textInput(['placeholder' => 'Fahrtrichtung'])->label(false) ?></td>
        <td><?= $form->field($newEntry, 'file_path')->fileInput()->label(false) ?>
        </td>
        <td colspan="2">
            <?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Erstellen', ['class' => 'btn btn-primary']); ?>
        </td>
    </tr>
    <?php
    ActiveForm::end();

    foreach ($items as $item) {
        $form = ActiveForm::begin(['action' => ['vvsedit'], 'options' => ['enctype' => 'multipart/form-data']]);
        ?>
        <tr>
            <td>
                <?= $form->field($item, 'name')->textInput(['value' => $item->name])->label(false) ?>
            </td>
            <td>
                <?= $form->field($item, 'direction')->textInput(['value' => $item->direction])->label(false) ?>
            </td>
            <td>
                <?= $form->field($item, 'file_path')->fileInput()->label(false) ?>
            </td>
            <td width="1%">
                <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i>  Speichern', ['class' => 'btn btn-success']); ?>
            </td>
            <?php
            echo $form->field($item, 'id')->hiddenInput(['value' => $item->id])->label(false);
            ActiveForm::end();
            ?>
            <td>
                <?php
                $form = ActiveForm::begin(['action' => ['vvsdelete']]);
                echo Html::submitButton('<i class="glyphicon glyphicon-remove"></i> Löschen', ['data' => ['confirm' => 'Möchten Sie den Eintrag wirklich löschen?'], 'class' => 'btn btn-danger']);
                echo $form->field($item, 'id')->hiddenInput(['value' => $item->id])->label(false);
                ?>
            </td>
        </tr><?php
        ActiveForm::end();
    }
    ?>
</table>
