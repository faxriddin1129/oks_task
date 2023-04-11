<?php

namespace api\models\form;

use common\models\File;
use yii\web\BadRequestHttpException;

class FileUploadForm extends \yii\base\Model
{

    public $file;
    const BASE_URL = 'http://task.loc';

    public function rules()
    {
        return [
            [['file'], 'required'],
            [['file'], 'file', 'extensions'=>['jpg','png','jpeg'], 'maxSize'=>1042 * 1024 * 10],
        ];
    }

    public function save(){

        $target_dir = \Yii::getAlias('@api/web/upload/');
        $target_file = $target_dir . basename($this->file['name']);
        $imageFileType =  strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            throw new BadRequestHttpException('Sorry, only JPG, JPEG, PNG files are allowed.');
        }

        if ($this->file['size'] > 5000000) {
            throw new BadRequestHttpException('Sorry, your file is too large.');
        }

        $newName = time().'.'.$imageFileType;
        move_uploaded_file($this->file['tmp_name'], $target_dir.'/'.$newName);

        $fileModel = new File();
        $fileModel->url = self::BASE_URL."/api/upload/".$newName;
        if (!$fileModel->save()){
            throw new BadRequestHttpException('Please try again!');
        }

        return $fileModel;
    }

}