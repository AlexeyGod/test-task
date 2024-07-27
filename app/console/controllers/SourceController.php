<?php

namespace console\controllers;

use common\models\Sources;
use Exception;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Commands for managing news sources 
 */

Class SourceController extends Controller {

    public $message;

    /**
     * List of all sources and identifiers
     */
    public function actionList()
    {
        $models = Sources::find()->all();
        foreach ($models as $model)
            $this->stdout('#'.$model->id.' | '.$model->name.' | '.$model->url."\n");
        
        return ExitCode::OK;
    }

     /**
     * Deletes a source by id
     * @param int $int ID Source
     */
    public function actionDelete($id = '')
    {
        if (intval($id) <1) {
            $this->stdout($this->ansiFormat('ID должен быть целм числом', Console::FG_RED));
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $model = Sources::findOne(['id' => $id]);
        $model->delete();
        $this->stdout($this->ansiFormat('Источник с ID='.$id.' удален'."\n", Console::FG_RED));
        
        return ExitCode::OK;

    }

     /**
     * Create a new source
     * @param string $name
     * @param string $url
     */

    public function actionAdd($name, $url)
    {
        if (empty($name) || empty($url)) {
            $this->stdout($this->ansiFormat("Поля name и url не должны быть пустыми\n", Console::FG_RED));
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $model = new Sources();
        $model->name = $name;
        $model->url = $url;
        
        try {
            $model->save();
        }
        catch (Exception $e)
        {
            $this->stdout($this->ansiFormat("Произошла ошибка: ".$e->getMessage()."\n", Console::FG_RED));
            return ExitCode::UNSPECIFIED_ERROR;
        }

        $this->stdout($this->ansiFormat('Источник добавлен'."\n", Console::FG_RED));
        
        return ExitCode::OK;

    }
} 
