<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\modal;
use yii\bootstrap\ActiveForm;
use backend\models\DozentUpdateForm;
use backend\models\DozentPictureForm;

$this->title = 'Personen';
?>

<!-- <h1>Dozent</h1> -->


<div class="site-index">
    <table class="table" style="width: 100%;">
        <tr>
            <th>Name</th>
            <th>Vorname</th>
            <th>Position</th>
            <th style="width: 1%;"></th>
        </tr>


        <?php foreach ($dozents as $dozent) { ?>

            <tr>
                <td><?= $dozent->Name ?></td>
                <td><?= $dozent->Vorname ?></td>
                <td><?= $dozent->Position ?></td>
                <td>
                    <?php
                    Modal::begin([
                        'header' => '<h2>' . $dozent->Vorname . ' ' . $dozent->Name . '</h2>',
                        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-pencil"></i> bearbeiten', 'class' => 'btn btn-primary'],
                    ]);
                    ?>
                    <div>
                        <div id = "dozent-picture-wrapper">
                            <div id = "dozent-picture-choose-if-available" style = "float: left; width:100%; margin-bottom: 1em;">
                                <?php
                                $form = ActiveForm::begin([/*'action' => ['editdozentpicture'], */'options' => ['enctype' => 'multipart/form-data']]);

                                //$editDozentPicture = new DozentPictureForm();

                                if ($dozent->Picture != NULL) {
                                    echo "<div id=\"dozent-picture\" style=\"height: 100px;\">
                            <img style=\"height: 100%; margin-bottom: 15px;\" src=\"data:image;base64, " . chunk_split(base64_encode($dozent->Picture)) . "\"/>
                        </div>";
                                } else {
                                    echo "<div id=\"dozent-picture-dummy\" style=\"height: 100px;\">
                            <img style=\"height: 100%; margin-bottom: 15px;\" src=\"importantStuff/dummy.jpg\" />
                        </div>";
                                }
                                ?>
                            </div>
                            <div id="dozent-update-picture">
                                <?= $form->field($editDozentPictureUpdate->dozentPictureForm, 'picture')->fileInput()->label(false) ?>
                                <?= $form->field($editDozentPictureUpdate, 'id')->hiddenInput(['value' => $dozent->ID])->label(false) ?>
                                <button style="float: right; width: 100%; margin-bottom: 1.5em;" type="submit" class="btn btn-primary">
                                    <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Bild ändern
                                </button>
                            </div>
                        </div>
                        <?php
                        ActiveForm::end();

                        $form = ActiveForm::begin(['id' => 'edit-dozent-form', 'action' => ['editdozent']]);

                        $editDozent = new DozentUpdateForm();
                        ?>
                        <div style="clear: both;">
                            <hr>
                            <?= $form->field($editDozent, 'id')->hiddenInput(['value' => $dozent->ID])->label(false) ?>
                            <?= $form->field($editDozent, 'name')->textInput(['value' => $dozent->Name]) ?>
                            <?= $form->field($editDozent, 'vorname')->textInput(['value' => $dozent->Vorname]) ?>
                            <?= $form->field($editDozent, 'titel')->textInput(['value' => $dozent->Titel]) ?>
                            <?= $form->field($editDozent, 'position')->textInput(['value' => $dozent->Position]) ?>
                            <?= $form->field($editDozent, 'sprechzeiten')->textInput(['value' => $dozent->Sprechzeiten]) ?>
                            <?= $form->field($editDozent, 'raum')->textInput(['value' => $dozent->Raum]) ?>
                            <?= $form->field($editDozent, 'email')->textInput(['value' => $dozent->Email]) ?>
                            <?= $form->field($editDozent, 'telefon')->textInput(['value' => $dozent->Telefon]) ?>
                            <button style="width: 100%;" type="submit" class="btn btn-success">
                                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
                            </button>
                            <?php
                            ActiveForm::end();
                            $form = ActiveForm::begin(['id' => 'remove-dozent-form', 'action' => ['removedozent']]);
                            ?>
                            <?= $form->field($editDozent, 'id')->hiddenInput(['value' => $dozent->ID])->label(false) ?>
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
             <!--   <td><?= Html::a('<span style="float: right;" class="btn-label">Show all</span>', ['edit', 'id' => $dozent->ID], ['class' => 'btn btn-primary']) ?></td> -->
            </tr>

        <?php } ?>
    </table>

    <?php
    Modal::begin([
        'header' => '<h2>Neue Person</h2>',
        'toggleButton' => ['label' => '<i class="glyphicon glyphicon-plus"></i> Neue Person hinzufügen', 'class' => 'btn btn-primary'],
    ]);

    $form = ActiveForm::begin(['id' => 'new-dozent-form', 'action' => ['newdozent']]);

    $newDozent = new DozentUpdateForm();
    ?>

    <div>
        <?= $form->field($newDozent, 'name')->textInput(['placeholder' => 'Name']) ?>
        <?= $form->field($newDozent, 'vorname')->textInput(['placeholder' => 'Vorname']) ?>
        <?= $form->field($newDozent, 'titel')->textInput(['placeholder' => 'Titel']) ?>
        <?= $form->field($newDozent, 'position')->textInput(['placeholder' => 'Position']) ?>
        <?= $form->field($newDozent, 'sprechzeiten')->textInput(['placeholder' => 'Sprechzeiten']) ?>
        <?= $form->field($newDozent, 'raum')->textInput(['placeholder' => 'Raum']) ?>
        <?= $form->field($newDozent, 'email')->textInput(['placeholder' => 'Email']) ?>
        <?= $form->field($newDozent, 'telefon')->textInput(['placeholder' => 'Telefon']) ?>
        <button style="width: 100%;" type="submit" class="btn btn-success">
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Speichern
        </button>
    </div>
    <?php
    ActiveForm::end();
    Modal::end();
    ?>

<!-- <td><?= Html::a('<span style="float: left;" class="btn-label">Dozent hinzufügen</span>', ['edit', 'id' => NULL], ['class' => 'btn btn-primary']) ?></td> -->

</div>