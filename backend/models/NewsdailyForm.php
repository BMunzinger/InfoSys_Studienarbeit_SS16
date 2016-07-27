<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Newsdaily;

/**
 * ContactForm is the model behind the contact form.
 */
class NewsdailyForm extends Model {

    public $id;
    public $message;
    public $day;

    public function rules() {
        return [
            // name, email, subject and body are required
            [['id', 'message', 'day'], 'required'],
        ];
    }

    public function addDaily() {
        if ($this->validate()) {
            $addDaily = new Newsdaily();
            $addDaily->day = $this->day;
            $addDaily->message = $this->message;

            $addDaily->save();

            return true;
        } else {
            return false;
        }
    }

    public function deleteDaily() {
        if ($this->validate()) {
            Newsdaily::findOne($this->id)->delete();

            return true;
        } else {
            return false;
        }
    }

    public function editDaily() {
        if ($this->validate()) {
            $editDaily = Newsdaily::findOne($this->id);
            $editDaily->day = $this->day;
            $editDaily->message = $this->message;
            
            $editDaily->update();

            return true;
        } else {
            return false;
        }
    }

}
