<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Fach;

/**
 * ContactForm is the model behind the contact form.
 */
class KursUpdateForm extends Model {

    public $ID;
    public $Name;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['Name'], 'required'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function update() {
        if ($this->validate()) {
            $fach = Fach::findOne($this->ID);
            
            $fach->Name = $this->Name;
            $fach->update();

            return true;
        } else {
            return false;
        }
    }

    public function add() {
        if ($this->validate()) {
            $newFach = new Fach();
            $newFach->Name = $this->Name;

            $newFach->save();
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        if (Fach::findOne($this->ID)->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
