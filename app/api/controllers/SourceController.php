<?php

namespace api\controllers;

use yii\rest\ActiveController;

class SourceController extends ActiveController
{
    public $modelClass = 'common\models\Sources';   


    public function actionError()
    {
        header ("Content-type: text/plain");
        die("You query not defined!\n
        \n
        Use:\n
        GET /sources - return sources list\n
        POST /sources/create data: 'name', 'url' Create a new source\n
        DELETE /sources/(id) Delete source witch id#(id)");
    }
}