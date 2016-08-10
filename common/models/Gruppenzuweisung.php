<?php

namespace common\models;

use common\models\Nutzergruppen;
use \yii\db\ActiveRecord;

class Gruppenzuweisung extends ActiveRecord {

    
    public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'nutzergruppen_id'], 'required'],
        ];
    }
    
    public function getNutzergruppen() { // could be a static func as well
        return $this->hasOne(Nutzergruppen::className(), ['id' => 'nutzergruppen_id']);
    }

}
