<?php

namespace common\models;

use common\models\Fach;
use common\models\Dozent;
use yii\helpers\ArrayHelper;
use \yii\db\ActiveRecord;

/**
 * Signup form
 */
class Kursplan extends ActiveRecord {

    public function getDozent() { // could be a static func as well
        return $this->hasOne(Dozent::className(), ['ID' => 'Dozent']);
    }

    public function getFach() { // could be a static func as well
        return $this->hasOne(Fach::className(), ['ID' => 'Fach']);
    }

}
