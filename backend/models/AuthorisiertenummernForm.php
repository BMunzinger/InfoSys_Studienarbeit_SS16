<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AuthorisiertenummernForm extends Model {

    public $name;
    public $nummer;
    public $oldnumber;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'authorisiertenummern';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'nummer', 'oldnumber'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function update() {

        if ($this->validate()) {

            $updateNumber = Authorisiertenummern::findOne($this->oldnumber);
            $updateNumber->nummer = $this->nummer;
            $updateNumber->name = $this->name;
            $updateNumber->update();
            
            return true;
        } else {
            return false;
        }
    }

    public function addNumber() {
        if ($this->validate()) {
            // var_dump($this); die();

            $addNumber = new Authorisiertenummern();
            $addNumber->name = $this->name;
            $addNumber->nummer = $this->nummer;

            $addNumber->save();

            return true;
        } else {
            return false;
        }
    }

    public function deleteNumber() {
        if ($this->validate()) {
            Authorisiertenummern::findOne($this->nummer)->delete();
            return true;
        } else {
            return false;
        }
    }

}
