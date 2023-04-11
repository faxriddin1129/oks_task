<?php

namespace api\modules\v1\controllers;

use api\models\search\IndicatorSearch;
use common\components\CrudController;
use common\models\Indicator;

class IndicatorController extends CrudController
{

    public $modelClass = Indicator::class;
    public $searchModel = IndicatorSearch::class;

    public function actions()
    {
        $parent = parent::actions();
        unset($parent['index']);
        return $parent;
    }

    public function actionIndex()
    {
        $search = new IndicatorSearch();
        $dataProvider = $search->search(\Yii::$app->request->queryParams);

        return $dataProvider;
    }


}