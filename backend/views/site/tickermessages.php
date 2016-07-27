<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use backend\models\TickermeldungenForm;

$this->title = 'Tickermeldungen';
?>
<div class="site-index">
    <table class="table" style="width: 100%;">
        <tr>
            <th style="width: 8em;">Datum</th>
            <th>Text</th>
            <th style="width: 1%">Optionen</th>
        </tr>
        <?php
        foreach ($messages as $message) {
            ?>
            <tr>
                <td><?= $message->Ablaufdatum ?></td>
                <td><?= $message->text ?></td>
                <td>
                    <?php
                    Modal::begin([
                        'header' => 'Ändern',
                        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-pencil"></i> bearbeiten', 'class' => 'btn btn-primary'],
                    ]);

                    $form = ActiveForm::begin(['id' => 'edit-ticker-form', 'action' => ['editticker']]);
                    $editMessage = new TickermeldungenForm();
                    ?>

                    <?= $form->field($editMessage, 'ID')->hiddenInput(['value' => $message->ID])->label(false) ?>
                    <?= $form->field($editMessage, 'Ablaufdatum')->textInput(['value' => $message->Ablaufdatum]) ?>
                    <?= $form->field($editMessage, 'text')->textArea(['value' => $message->text, 'maxlength' => 255, 'rows' => 7, 'style' => 'resize: none;']) ?>
                    <button style="width: 100%;" type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
                    </button>

                    <?php
                    ActiveForm::end();

                    $form = ActiveForm::begin(['id' => 'delete-ticker-form', 'action' => ['deleteticker']]);
                    $deleteMessage = new TickermeldungenForm();
                    ?>

                    <?= $form->field($deleteMessage, 'ID')->hiddenInput(['value' => $message->ID])->label(false) ?>
                    <?= $form->field($deleteMessage, 'Ablaufdatum')->hiddenInput(['value' => $message->Ablaufdatum])->label(false) ?>
                    <?= $form->field($deleteMessage, 'text')->hiddenInput(['value' => $message->text])->label(false) ?>

                    <button style="width: 100%;" type="submit" class="btn btn-danger">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                    </button>

                    <?php
                    ActiveForm::end();
                    Modal::end();
                    ?>

                </td>
            </tr>
            <?php
        }
        ?>

    </table>

    <?php
    Modal::begin([
        'header' => 'Tickermeldung hinzufügen',
        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-plus"></i> Tickermeldung hinzufügen', 'class' => 'btn btn-primary'],
    ]);

    $form = ActiveForm::begin(['id' => 'add-ticker-form', 'action' => ['addticker']]);
    $addMessage = new TickermeldungenForm();
    ?>

    <?= $form->field($addMessage, 'Ablaufdatum')->textInput(['placeholder' => 'JJJJ-MM-DD']) ?>
    <?= $form->field($addMessage, 'text')->textArea(['placeholder' => 'Text hinzufügen...', 'maxlength' => 255, 'rows' => 7, 'style' => 'resize: none;']) ?>

    <button style="width: 100%;" type="submit" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Hinzufügen
    </button>


    <?php
    ActiveForm::end();
    Modal::end();
    ?>
</div>