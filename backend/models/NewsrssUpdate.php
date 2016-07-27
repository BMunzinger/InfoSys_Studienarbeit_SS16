<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\Newsrss;

/**
 * ContactForm is the model behind the contact form.
 */
class NewsrssUpdate extends Model {
    public $id;
    public $URL;
    public $Description;
    
    public function rules() {
        return [
            // name, email, subject and body are required
            [['id', 'URL'], 'required'],
        ];
    }
    
    public function update(){
        if ($this->validate()) {
        $updateNews = Newsrss::findOne($this->id);
        $updateNews->URL = $this->URL;
        $updateNews->Description = $this->Description;
        $updateNews->save();
        return true;
        } else {
            return false;
        }
    }
}
