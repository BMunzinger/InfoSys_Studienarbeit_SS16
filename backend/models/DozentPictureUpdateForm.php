<?php

namespace backend\models;

use yii\base\Model;
use common\models\Dozent;

class DozentPictureUpdateForm extends Model {
    
      public $dozentPictureForm;
      public $id;
      
      public function rules() {
        return [
            // name, email, subject and body are required
            [['dozentPictureForm', 'id'], 'required'],
        ];
    }
    
    public function upload() {
        if($this->validate()) {
            if($this->dozentPictureForm->upload($this->id)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}