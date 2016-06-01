<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use backend\models\AuthorisiertenummernForm;

$this->title = 'SMS-Meldungen';
?>
<div class="site-index">
    <!--<button type="button" class="btn btn-default" aria-label="Add new!" style="margin-bottom: 20px;">
        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new Entry!
    </button>-->
    <table class="table" style="width: 100%;">
        <tr>
            <th>Name</th>
            <th>Nummer</th>
            <th>Options</th>
        </tr>
        <?php foreach ($numbers as $number) { ?>
            <?php $form = ActiveForm::begin(['id' => 'number-form']); ?>
            <tr>
                <td>
                    <?= $form->field($number, 'name')->textInput(['value' => $number->name])->label(false) ?>
                </td>
                <td>
                    <?= $form->field($number, 'nummer')->textInput(['value' => $number->nummer])->label(false) ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" aria-label="Edit">
                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
                    </button>
                    <button type="button" class="btn btn-danger" aria-label="Remove">
                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Remove
                    </button>
                </td>
            </tr>
            <?php ActiveForm::end(); ?>
        <?php } ?>
        <?php
        $form = ActiveForm::begin(['action' => 'SiteController/addNumber']);
        $numbermodel = new AuthorisiertenummernForm;
        ?>
        <tr>
            <td><?= $form->field($numbermodel, 'name')->textInput(['placeholder' => 'Name'])->label(false) ?></td>
            <td><?= $form->field($numbermodel, 'nummer')->textInput(['placeholder' => 'Nummer'])->label(false) ?></td>
            <td>
                <button type="submit" class="btn btn-primary" aria-label="Add new!">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add new Entry!
                </button>
            </td>
        </tr>
<?php ActiveForm::end(); ?>
    </table>
</div>
