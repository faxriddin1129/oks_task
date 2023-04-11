<?php

namespace api\modules\v1\controllers;

use api\models\search\NewsSearch;
use common\components\CrudController;
use common\models\News;

class NewsController extends CrudController
{

    public $modelClass = News::class;
    public $searchModel = NewsSearch::class;

    public function actions()
    {
        $parent = parent::actions();
        unset($parent['index']);
        return $parent;
    }

    public function actionIndex()
    {
        $search = new NewsSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);

        return $dataProvider;
    }


}