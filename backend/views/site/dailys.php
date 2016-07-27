<?php
/* @var $this yii\web\View */

use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use backend\models\NewsdailyForm;

$this->title = 'Daily-News';
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
                <td><?= $message->day ?></td>
                <td><?= $message->message ?></td>
                <td>
                    <?php
                    Modal::begin([
                        'header' => 'Ändern',
                        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-pencil"></i> bearbeiten', 'class' => 'btn btn-primary'],
                    ]);

                    $form = ActiveForm::begin(['id' => 'edit-daily-form', 'action' => ['editdaily']]);
                    $editMessage = new NewsdailyForm();
                    ?>

                    <?= $form->field($editMessage, 'id')->hiddenInput(['value' => $message->id])->label(false) ?>
                    <?= $form->field($editMessage, 'day')->textInput(['value' => $message->day]) ?>
                    <?= $form->field($editMessage, 'message')->textArea(['value' => $message->message, 'maxlength' => 255, 'rows' => 7, 'style' => 'resize: none;']) ?>
                    <button style="width: 100%;" type="submit" class="btn btn-success">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
                    </button>

                    <?php
                    ActiveForm::end();

                    $form = ActiveForm::begin(['id' => 'delete-daily-form', 'action' => ['deletedaily']]);
                    $deleteMessage = new NewsdailyForm();
                    ?>

                    <?= $form->field($deleteMessage, 'id')->hiddenInput(['value' => $message->id])->label(false) ?>
                    <?= $form->field($deleteMessage, 'day')->hiddenInput(['value' => $message->day])->label(false) ?>
                    <?= $form->field($deleteMessage, 'message')->hiddenInput(['value' => $message->message])->label(false) ?>

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
        'header' => 'Daily-News hinzufügen',
        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-plus"></i> Daily-News hinzufügen', 'class' => 'btn btn-primary'],
    ]);

    $form = ActiveForm::begin(['id' => 'add-daily-form', 'action' => ['adddaily']]);
    $addMessage = new NewsdailyForm();
    ?>

    <?= $form->field($addMessage, 'day')->textInput(['placeholder' => 'JJJJ-MM-DD']) ?>
    <?= $form->field($addMessage, 'message')->textArea(['placeholder' => 'Text hinzufügen...', 'maxlength' => 255, 'rows' => 7, 'style' => 'resize: none;']) ?>

    <button style="width: 100%;" type="submit" class="btn btn-primary">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Hinzufügen
    </button>


    <?php
    ActiveForm::end();
    Modal::end();
    ?>
</div>