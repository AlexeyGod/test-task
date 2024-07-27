<?php

namespace frontend\controllers;

use common\models\News;
use yii\web\Controller;
use yii\data\Pagination;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = News::find();
        $pages = new Pagination(['totalCount' => $query->count()]);
        $news = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->all();
        
        return $this->render('index', compact('news', 'pages'));

        
    }

    public function actionView($id)
    {
        $model = News::findOne($id);

        return $this->render('view', ['model' => $model]);
    }
}
