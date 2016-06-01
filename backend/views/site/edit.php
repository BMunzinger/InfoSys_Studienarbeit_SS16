<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;

$this->title = 'Edit';
?>
<div class="site-index">
    <h1 style="border-bottom: 1px solid #222222;"><?= $model->Vorname ?> <?= $model->Name ?></h1>

    <?php
    $form = ActiveForm::begin(['id' => 'dozent-form']);

    $modelUpdate->fächer[0] = "eins";
    $modelUpdate->fächer[1] = "zwei";
    
    $modelUpdate->funktionen[0] = "funktionalitaeritaet";
    
    $modelUpdate->praktika[0] = "theoretischpraxis";
            
    $modelUpdate->studienarbeiten[0] = "studiereundarbeite";
    
    $modelUpdate->thesen[0] = "praktischthesen";
    ?>

    <div id="dozent-overview" style=" height: 21em;">
        <div id="dozent-info" style="float: left; width: 70%;">

            <div>
                <?= $form->field($modelUpdate, 'name')->textInput(['value' => $model->Name]) ?>
                <?= $form->field($modelUpdate, 'vorname')->textInput(['value' => $model->Vorname]) ?>
                <?= $form->field($modelUpdate, 'titel')->textInput(['value' => $model->Titel]) ?>
                <?= $form->field($modelUpdate, 'position')->textInput(['value' => $model->Position]) ?>
                <?= $form->field($modelUpdate, 'sprechzeiten')->textInput(['value' => $model->Sprechzeiten]) ?>
                <?= $form->field($modelUpdate, 'raum')->textInput(['value' => $model->Raum]) ?>
                <?= $form->field($modelUpdate, 'email')->textInput(['value' => $model->Email]) ?>
                <?= $form->field($modelUpdate, 'telefon')->textInput(['value' => $model->Telefon]) ?>
            </div>

        </div>
        <div id="dozent-picture-wrapper" style="float: right; width: 28%; height: 16em;">
            <div id="dozent-picture" style="width: 100%;">
                <img style="width: 100%;" src="data:image;base64, <?= chunk_split(base64_encode($model->Picture)) ?> "/>
            </div>
            <button style="float: right;" type="button" class="btn btn-primary">Change Picture!</button>
        </div>
    </div>

    <div style="clear: both;">

        <div class="panel panel-default">
            <div class="panel-heading">Fächer</div>
            <div class="panel-body">
                <?php
                foreach ($modelUpdate->fächer as $fach) {
                    echo($form->field($modelUpdate, $fach)->textarea(['value' => $fach])->label(false));
                }
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Funktion</div>
            <div class="panel-body">
                <?php
                foreach ($modelUpdate->funktionen as $funktion) {
                    echo($form->field($modelUpdate, $funktion)->textarea(['value' => $funktion])->label(false));
                }
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Prakitika</div>
            <div class="panel-body">
                <?php
                foreach ($modelUpdate->praktika as $praktikum) {
                    echo($form->field($modelUpdate, $praktikum)->textarea(['value' => $praktikum])->label(false));
                }
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Studienarbeiten</div>
            <div class="panel-body">
                <?php
                foreach ($modelUpdate->studienarbeiten as $studienarbeit) {
                    echo($form->field($modelUpdate, $studienarbeit)->textarea(['value' => $studienarbeit])->label(false));
                }
                ?>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">Thesen</div>
            <div class="panel-body">
                <?php
                foreach ($modelUpdate->thesen as $thesis) {
                    echo($form->field($modelUpdate, $thesis)->textarea(['value' => $thesis])->label(false));
                }
                ?>
            </div>
        </div>

    </div>

    <button style="float: right;" type="submit" class="btn btn-primary">Save!</button>

    <?php ActiveForm::end(); ?>

</div>
