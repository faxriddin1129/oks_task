<?php

namespace api\modules\v1\controllers;

use api\models\form\FileUploadForm;
use common\components\ApiController;
use yii\web\BadRequestHttpException;

class FileController extends ApiController
{

    public function actionUpload(){
        $model = new FileUploadForm();
        if (!empty($_FILES['file'])){
            $model->file = $_FILES['file'];
            return $model->save();
        }
        throw new BadRequestHttpException('File required!');
    }

}