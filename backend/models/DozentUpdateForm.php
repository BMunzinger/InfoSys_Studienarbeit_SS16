<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class DozentUpdateForm extends Model {

    public $name;
    public $vorname;
    public $titel;
    public $position;
    public $sprechzeiten;
    public $raum;
    public $telefon;
    public $picture;
    public $email;
    
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'vorname', 'titel', 'position', 'sprechzeiten', 'raum', 'telefon', 'email'], 'required'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param  string  $email the target email address
     * @return boolean whether the email was sent
     */
    public function update($model) {
        //  var_dump($model);
        //  var_dump($modelUpdate);
        //  die();


        if ($this->validate()) {
            $model->Name = $this->name;
            $model->Vorname = $this->vorname;
            $model->Titel = $this->titel;
            $model->Position = $this->position;
            $model->Sprechzeiten = $this->sprechzeiten;
            $model->Raum = $this->raum;
            $model->Telefon = $this->telefon;
            $model->Email = $this->email;
            $model->update();

            return true;
        } else {
            return false;
        }
    }

}
