<?php
/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Dozent';
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
                <td><?= Html::a('<span style="float: right;" class="btn-label">Show all</span>', ['edit', 'id' => $dozent->ID], ['class' => 'btn btn-primary']) ?></td>
            </tr>

        <?php } ?>


    </table>
</div>