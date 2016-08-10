<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\modal;
use yii\bootstrap\ActiveForm;
use backend\models\KursUpdateForm;

$this->title = 'Fach';
?>

<!-- <h1>Fach</h1> -->


<div class="site-index">
    <table class="table" style="width: 100%;">
        <tr>
            <th>Name</th>
            <th colspan="2" width="1%"></th>
        </tr>
        <tr>
            <?php
            $form = ActiveForm::begin(['id' => 'new-kurs-form', 'action' => ['newkurs']]);

            $newKurs = new KursUpdateForm();
            ?>

            <td><?= $form->field($newKurs, 'Name')->textInput(['placeholder' => 'Name'])->label(false); ?></td>
            <td colspan="2"><?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Neuen Kurs hinzufügen', ['class' => 'btn btn-primary']); ?></td>
            <?php
            ActiveForm::end();
            ?>

        </tr>

        <?php foreach ($items as $item) { ?>

            <tr>
                <?php
                $form = ActiveForm::begin(['id' => 'edit-kurs-form', 'action' => ['editkurs']]);

                $editKurs = new KursUpdateForm();
                ?>
                <td>

                    <?= $form->field($editKurs, 'Name')->textInput(['value' => $item->Name])->label(false) ?>
                </td>
                <td>
                    <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> Speichern', ['class' => 'btn btn-success']); ?>
                </td>
                <?= $form->field($editKurs, 'ID')->hiddenInput(['value' => $item->ID])->label(false); ?>
                <?php ActiveForm::end(); ?>

                <?php
                $form = ActiveForm::begin(['id' => 'remove-kurs-form', 'action' => ['removekurs']]);
                echo $form->field($editKurs, 'ID')->hiddenInput(['value' => $item->ID])->label(false);
                ?>
                <td>
                    <?= Html::submitButton('<i class="glyphicon glyphicon-remove"></i> Löschen', ['class' => 'btn btn-danger']); ?>
                </td>
                <?php
                ActiveForm::end();
                ?>
            </tr>

        <?php } ?>
    </table>
</div>