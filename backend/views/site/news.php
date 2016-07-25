<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'News';
?>
<div class="site-index">
    <table class="table" style="width: 100%;">



        <tr>
            <th>URL</th>
            <th></th>
        </tr>
        <?php $form = ActiveForm::begin(['id' => 'news-form']); ?>
        <tr>
            <td>
               <input class="form-control" type="text" name="fname" value="*URL*"><br>
            </td>
            <td>
                <button type="button" class="btn btn-success" aria-label="Edit">
                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Save
                </button>
            </td>
        </tr>
        <?php ActiveForm::end(); ?>
    </table>


</div>
