<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Dozent;

/**
 * ContactForm is the model behind the contact form.
 */
class DozentUpdateForm extends Model {

    public $id;
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
            [['id', 'name', 'vorname', 'titel', 'position', 'sprechzeiten', 'raum', 'telefon', 'email'], 'required'],
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
            $dozent = Dozent::findOne($this->id);
            
            $dozent->Name = $this->name;
            $dozent->Vorname = $this->vorname;
            $dozent->Titel = $this->titel;
            $dozent->Position = $this->position;
            $dozent->Sprechzeiten = $this->sprechzeiten;
            $dozent->Raum = $this->raum;
            $dozent->Telefon = $this->telefon;
            $dozent->Email = $this->email;
            $dozent->update();

            return true;
        } else {
            return false;
        }
    }

    public function add() {
        if ($this->validate()) { 
            $newDozent = new Dozent();
            $newDozent->Name = $this->name;
            $newDozent->Vorname = $this->vorname;
            $newDozent->Titel = $this->titel;
            $newDozent->Position = $this->position;
            $newDozent->Sprechzeiten = $this->sprechzeiten;
            $newDozent->Raum = $this->raum;
            $newDozent->Telefon = $this->telefon;
            $newDozent->Email = $this->email;

            $newDozent->save();
            return true;
        } else {
            return false;
        }
    }

    public function delete() {
        if (Dozent::findOne($this->id)->delete()) {
            return true;
        } else {
            return false;
        }
    }
}
