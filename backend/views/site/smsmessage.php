<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use backend\models\AuthorisiertenummernForm;
use yii\helpers\Html;

$this->title = 'SMS-Meldungen';
?>
<h1>SMS-Meldungen</h1>
<div class="site-index">
    <table class="table" style="width: 100%;">
        <tr>
            <th>Name</th>
            <th>Nummer</th>
            <th style="width: 1%">Optionen</th>
            <th style="width: 1%"></th>
        </tr>
         <?php
        $form = ActiveForm::begin(['id' => 'addNumber', 'action' => ['addnumber']]);
        ?>
        <tr>
            <td><?= $form->field($changedNumber, 'name')->textInput(['placeholder' => 'Name'])->label(false) ?></td>
            <td><?= $form->field($changedNumber, 'nummer')->textInput(['placeholder' => 'Nummer'])->label(false) ?></td>
            <td colspan="2">
                <button type="submit" method="post" name="addNew" value="addNew" class="btn btn-primary" aria-label="Add new!">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neuen Eintrag einfügen
                </button>
            </td>
        </tr>
        <?php ActiveForm::end(); ?>
        <?php foreach ($numbers as $number) { ?>
            <?php $form = ActiveForm::begin(['id' => 'editNumber', 'action' => ['editnumber']]); 
            ?>
        <?= $form->field($changedNumber, 'oldnumber')->hiddenInput(['value' => $number->nummer])->label(false) ?>
                    <?php //$changedNumber->oldnumber = $number->nummer; ?>
            <tr>
                <td>
                    <?= $form->field($changedNumber, 'name')->textInput(['value' => $number->name])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($changedNumber, 'nummer')->textInput(['value' => $number->nummer])->label(false) ?>
                </td>
                <td>
                    <button type="submit" name="edit" value="edit" class="btn btn-success" aria-label="Edit">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
                    </button>
                    <?php ActiveForm::end(); ?>
                </td>
                <td>
                    <?php $form = ActiveForm::begin(['id' => 'removenumber', 'action' => ['removenumber']]); ?>
                    <?= Html::submitButton('<i class="glyphicon glyphicon-remove"></i> Löschen', ['data' => ['confirm' => 'Möchten Sie den Eintrag wirklich löschen?'], 'class' => 'btn btn-danger']); ?>
                    <?= $form->field($changedNumber, 'name')->hiddenInput(['value' => $number->name])->label(false) ?>
                    <?= $form->field($changedNumber, 'nummer')->hiddenInput(['value' => $number->nummer])->label(false) ?>
                    <?= $form->field($changedNumber, 'oldnumber')->hiddenInput(['value' => $number->nummer])->label(false) ?>
                    <?php ActiveForm::end(); ?>
                </td>
            </tr>
            
        <?php } ?>
        <?php
        $form = ActiveForm::begin(['id' => 'addNumber', 'action' => ['addnumber']]);
        ?>
        <tr>
            <td><?= $form->field($changedNumber, 'name')->textInput(['placeholder' => 'Name'])->label(false) ?></td>
            <td><?= $form->field($changedNumber, 'nummer')->textInput(['placeholder' => 'Nummer'])->label(false) ?></td>
            <td colspan="2">
                <button type="submit" method="post" name="addNew" value="addNew" class="btn btn-primary" aria-label="Add new!">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Neuen Eintrag einfügen
                </button>
            </td>
        </tr>
        <?php ActiveForm::end(); ?>
    </table>
</div>
