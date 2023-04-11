<?php

namespace api\modules\v1\controllers;

use api\models\search\CategorySearch;
use common\components\CrudController;
use common\models\Category;

class CategoryController extends CrudController
{

    public $modelClass = Category::class;
    public $searchModel = CategorySearch::class;

    public function actions()
    {
        $parent = parent::actions();
        unset($parent['index']);
        return $parent;
    }

    public function actionIndex()
    {
        $search = new CategorySearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);

        return $dataProvider;
    }


}