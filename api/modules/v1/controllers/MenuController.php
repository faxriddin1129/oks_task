<?php

namespace api\modules\v1\controllers;

use api\models\search\MenuSearch;
use common\components\CrudController;
use common\models\Menu;

class MenuController extends CrudController
{

    public $modelClass = Menu::class;
    public $searchModel = MenuSearch::class;

    public function actions()
    {
        $parent = parent::actions();
        unset($parent['index']);
        return $parent;
    }

    public function actionIndex()
    {
        $search = new MenuSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);

        return $dataProvider;
    }


}