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
            <th width="1%"></th>
        </tr>


        <?php foreach ($items as $item) { ?>

            <tr>
                <td><?= $item->Name ?></td>
                <td>
                    <?php
                    Modal::begin([
                        'header' => '<h2>' . $item->Name . '</h2>',
                        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-pencil"></i> bearbeiten', 'class' => 'btn btn-primary'],
                    ]);
                    ?>
                    <div>
                        <?php
                        $form = ActiveForm::begin(['id' => 'edit-kurs-form', 'action' => ['editkurs']]);

                        $editKurs = new KursUpdateForm();
                        ?>
                        <div style="clear: both;">
                            <hr>
                            <?= $form->field($editKurs, 'ID')->hiddenInput(['value' => $item->ID])->label(false) ?>
                            <?= $form->field($editKurs, 'Name')->textInput(['value' => $item->Name]) ?>
                            <button style="width: 100%;" type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
                            </button>
                            <?php
                            ActiveForm::end();
                            $form = ActiveForm::begin(['id' => 'remove-kurs-form', 'action' => ['removekurs']]);
                            ?>
                            <?= $form->field($editKurs, 'ID')->hiddenInput(['value' => $item->ID])->label(false) ?>
                            <button style="width: 100%;" type="submit" class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Löschen
                            </button>
                        </div>
                    </div>

                    <?php
                    ActiveForm::end();
                    Modal::end();
                    ?>
                </td>
             <!--   <td><?= Html::a('<span style="float: right;" class="btn-label">Show all</span>', ['edit', 'id' => $item->ID], ['class' => 'btn btn-primary']) ?></td> -->
            </tr>

        <?php } ?>
    </table>

    <?php
    Modal::begin([
        'header' => '<h2>Neuer Kurs</h2>',
        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-plus"></i> Neuen Kurs hinzufügen', 'class' => 'btn btn-primary'],
    ]);

    $form = ActiveForm::begin(['id' => 'new-kurs-form', 'action' => ['newkurs']]);

    $newKurs = new KursUpdateForm();
    ?>

    <div>
        <?= $form->field($newKurs, 'Name')->textInput(['placeholder' => 'Name']) ?>
        <button style="width: 100%;" type="submit" class="btn btn-success">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
        </button>
    </div>
    <?php
    ActiveForm::end();
    Modal::end();
    ?>

<!-- <td><?= Html::a('<span style="float: left;" class="btn-label">Kurs hinzufügen</span>', ['edit', 'id' => NULL], ['class' => 'btn btn-primary']) ?></td> -->

</div>