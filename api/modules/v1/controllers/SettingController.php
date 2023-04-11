<?php

namespace api\modules\v1\controllers;

use api\models\search\SettingSearch;
use common\components\CrudController;
use common\models\Setting;

class SettingController extends CrudController
{

    public $modelClass = Setting::class;
    public $searchModel = SettingSearch::class;

    public function actions()
    {
        $parent = parent::actions();
        unset($parent['index']);
        unset($parent['delete']);
        return $parent;
    }

    public function actionIndex()
    {
        $search = new SettingSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);

        return $dataProvider;
    }


}