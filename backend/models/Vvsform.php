<?php

namespace backend\models;

use common\models\Vvs;
use yii\base\Model;
use yii\web\UploadedFile;

/**
 * Signup form
 */
class Vvsform extends Model {

    public $name;
    public $direction;
    public $file_path;

    public function rules() {
        return [
//            [['name', 'direction'], 'required'],
        ];
    }

    public function add() {
        if ($this->validate()) {

            $newEntry = new Vvs();

//            $newEntry->saveAs('uploads/' . $newEntry->baseName . '.' . $newEntry->extension);

            $newEntry->name = $this->name;
            $newEntry->direction = $this->direction;
            $newEntry->file_path = $this->file_path;

            $newEntry->save();
            return true;
        }
        return false;
    }



}
