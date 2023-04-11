<?php

namespace api\controllers;

use yii\rest\Controller;
use yii\rest\OptionsAction;

class SiteController extends Controller
{

    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class
            ]
        ];

    }


    public function actionIndex()
    {
        return [
            'Welcome To OKS Task!'
        ];
    }
}