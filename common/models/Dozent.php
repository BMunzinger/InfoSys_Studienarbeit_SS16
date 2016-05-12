<?php
namespace common\models;

use \yii\db\ActiveRecord;

/**
 * Signup form
 */
class Dozent extends ActiveRecord
{
    public $id;
    public $position;
    public $titel;
    public $name;
    public $vorname;
    public $sprechzeiten;
    public $raum;
    public $telefon;
    public $picture;
    public $email;

}
