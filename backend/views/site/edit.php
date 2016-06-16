<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Edit';
?>
<div class="site-index">
    <div>
        <h1 style="border-bottom: 1px solid #222222;"><?= $model->Vorname ?> <?= $model->Name ?></h1>
    </div>

    <div id="dozent-overview" style=" height: 21em;">

        <div id="dozent-info" style="float: left; width: 70%;">
            <?php
            $form = ActiveForm::begin(['id' => 'dozent-form']);
            ?>
            <div>
                <?= $form->field($modelUpdate, 'name')->textInput(['value' => $model->Name]) ?>
                <?= $form->field($modelUpdate, 'vorname')->textInput(['value' => $model->Vorname]) ?>
                <?= $form->field($modelUpdate, 'titel')->textInput(['value' => $model->Titel]) ?>
                <?= $form->field($modelUpdate, 'position')->textInput(['value' => $model->Position]) ?>
                <?= $form->field($modelUpdate, 'sprechzeiten')->textInput(['value' => $model->Sprechzeiten]) ?>
                <?= $form->field($modelUpdate, 'raum')->textInput(['value' => $model->Raum]) ?>
                <?= $form->field($modelUpdate, 'email')->textInput(['value' => $model->Email]) ?>
                <?= $form->field($modelUpdate, 'telefon')->textInput(['value' => $model->Telefon]) ?>
                <button style="float: right; width: 100%;" type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
                </button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div id="dozent-picture-wrapper" style="float: right; width: 28%; height: 16em;">
            <?php
            $form = ActiveForm::begin([
                        'options' => ['enctype' => 'multipart/form-data'],
                            ]
            );
            ?>

            <div id="dozent-picture" style="width: 100%;">
                <img style="width: 100%; margin-bottom: 15px;" src="data:image;base64, <?= chunk_split(base64_encode($model->Picture)) ?> "/>
            </div>
            <?= $form->field($modelPicture, 'picture')->fileInput()->label('Neues Bild wählen:') ?>
            <button style="float: right; width: 100%;" type="submit" class="btn btn-primary">
                <span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Change Picture
            </button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div style="clear:both;"></div>



</div>
