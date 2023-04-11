<?php

namespace api\modules\v1\controllers;

use yii\rest\Controller;

class DefaultController extends Controller
{
    public function actionIndex(){
        return 'Welcome To OKS Task!';
    }
}