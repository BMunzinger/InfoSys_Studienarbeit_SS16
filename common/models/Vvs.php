<?php
namespace common\models;

use \yii\db\ActiveRecord;

/**
 * Signup form
 */
class Vvs extends ActiveRecord
{
public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'direction', 'file_path'], 'required'],
        ];
    }
}
