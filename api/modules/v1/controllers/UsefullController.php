<?php

namespace api\modules\v1\controllers;

use api\models\search\UsefulLinkSearch;
use common\components\CrudController;
use common\models\UsefulLink;

class UsefullController extends CrudController
{

    public $modelClass = UsefulLink::class;
    public $searchModel = UsefulLinkSearch::class;

    public function actions()
    {
        $parent = parent::actions();
        unset($parent['index']);
        return $parent;
    }

    public function actionIndex()
    {
        $search = new UsefulLinkSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);

        return $dataProvider;
    }


}