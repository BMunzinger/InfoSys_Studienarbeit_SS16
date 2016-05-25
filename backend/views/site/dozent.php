<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

//$this->title = 'About';
//$this->params['breadcrumbs'][] = $this->title;
 ?>

<table>
    <tr>
    <th>Name</th>
    <th>Vorname</th>
    </tr>
<?php foreach ($dozents as $dozent) { ?>
<tr>
    <td><?= $dozent->Name ?></td>
    <td><?= $dozent->Vorname ?></td>
</tr>
<?php } ?>
</table>