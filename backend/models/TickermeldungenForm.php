<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Tickermeldungen;

/**
 * ContactForm is the model behind the contact form.
 */
class TickermeldungenForm extends Model {

    public $ID;
    public $text;
    public $Ablaufdatum;

    public function rules() {
        return [
            // name, email, subject and body are required
            [['ID', 'text', 'Ablaufdatum'], 'required'],
        ];
    }

    public function addTicker() {
        if ($this->validate()) {
            $addTicker = new Tickermeldungen();
            $addTicker->Ablaufdatum = $this->Ablaufdatum;
            $addTicker->text = $this->text;

            $addTicker->save();

            return true;
        } else {
            return false;
        }
    }

    public function deleteTicker() {
        if ($this->validate()) {
            Tickermeldungen::findOne($this->ID)->delete();

            return true;
        } else {
            return false;
        }
    }

    public function editTicker() {
        if ($this->validate()) {
            $editTicker = Tickermeldungen::findOne($this->ID);
            $editTicker->Ablaufdatum = $this->Ablaufdatum;
            $editTicker->text = $this->text;
            
            $editTicker->update();

            return true;
        } else {
            return false;
        }
    }

}
