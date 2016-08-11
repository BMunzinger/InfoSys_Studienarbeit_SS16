<?php
/* @var $this yii\web\View */

use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = 'Nutzergruppen';
?>
<div class="site-index">
    <table class="table" style="width: 100%;">
        <tr>
            <th>Benutzername</th>
            <th>Gruppe</th>
            <th style="width: 1%"></th>
            <th style="width: 1%"></th>
        </tr>
        <?php $form = ActiveForm::begin(['action' => ['usergroupsadd']]); ?>
        <tr>
            <td><?= $form->field($newEntry, 'name')->label(false); ?></td>
            <td><?=
                        $form->field($newEntry, 'nutzergruppen_id')
                        ->dropDownList(ArrayHelper::map(common\models\Nutzergruppen::find()->all(), 'id', 'gruppe'), ['prompt' => 'Gruppe auswählen'])->label(false);
                ?></td>
            <td colspan="2"><?= Html::submitButton('<i class="glyphicon glyphicon-plus"></i> Erstellen', ['class' => 'btn btn-primary']); ?></td>
        </tr>
        <?php
        ActiveForm::end();
        foreach ($usergroups as $usergroup) {
            $form = ActiveForm::begin(['action' => ['usergroupsedit']]);
            ?>
            <tr>
                <td><?= $form->field($usergroup, 'name')->label(false); ?></td>
                <td><?=
                            $form->field($usergroup, 'nutzergruppen_id')
                            ->dropDownList(ArrayHelper::map(common\models\Nutzergruppen::find()->all(), 'id', 'gruppe'), ['prompt' => 'Gruppe auswählen'])->label(false);
                    ?></td>
                <td><?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> Speichern', ['class' => 'btn btn-success']); ?></td>
                <?php
                echo $form->field($usergroup, 'id')->hiddenInput()->label(false);
                ActiveForm::end();
                ?>
                <td>
                    <?php
                    $form = ActiveForm::begin(['action' => ['usergroupsdelete']]);
                    echo Html::submitButton('<i class="glyphicon glyphicon-remove"></i>  Löschen', ['data' => ['confirm' => 'Möchten Sie den Eintrag wirklich löschen?'], 'class' => 'btn btn-danger']);
                    echo $form->field($usergroup, 'id')->hiddenInput()->label(false);
                    ?>
                </td>
            </tr>
            <?php
            ActiveForm::end();
        }
        ?>
    </table>
</div>
