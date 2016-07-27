<?php

namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\Dozent;

class DozentPictureForm extends Model {

    /**
     * @var UploadedFile
     */
    public $picture;

    public function rules() {
        return [
            ['picture', 'image', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($id) {
        if ($this->validate()) {

            //var_dump($this); die();
           // $this->picture->saveAs('../../common/web/dozentPictures/' . $this->picture->baseName . '.' . $this->picture->extension);

            $dozent = Dozent::findOne($id);
          
            $dozent->Picture = file_get_contents($this->picture->tempName);
            $dozent->save();
            
         /*   $image->file = UploadedFile::getInstance($image, 'file');

            if ($image->file) {
                $user->image_blob = file_get_contents($image->file->tempName);
                $user->save();
            }

*/
            //$model->PicturePath = ($this->picture->baseName . '.' . $this->picture->extension);
            //$model->update();
            return true;
        } else {
            return false;
        }
    }

}
