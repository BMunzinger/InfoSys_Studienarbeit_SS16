<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class DozentPictureForm extends \yii\db\ActiveRecord {

    public $picture;

    public function rules() {
        return [
            ['picture', 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($model)
    {
        if ($this->validate()) {
            //var_dump($this->picture); die();
            $this->picture->saveAs('../../common/web/dozentPictures/' . $this->picture->baseName . '.' . $this->picture->extension);
            $model->PicturePath = ($this->picture->baseName . '.' . $this->picture->extension);
            $model->update();
            return true;
        } else {
            return false;
        }
    }
}
