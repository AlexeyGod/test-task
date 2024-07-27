<?php

namespace console\controllers;

use common\models\Sources;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Commands for import news  from sources
 * As examle use sources: https://www.mk.ru/rss/
 * example: https://www.mk.ru/rss/news/index.xml, https://www.mk.ru/rss/daily/index.xml
 * 
 */

Class ImportController extends Controller {

    public $message;

    /**
     * Run import news from soursec
     */
    public function actionStart()
    {
        $this->_realImport();
        
        return ExitCode::OK;
    }

    public function displayErrors($title = "", $errors = [])
    {
        if(count($errors) < 1) return true;
        if (!empty ($title))
        $this->stdout($this->ansiFormat("Выявленные ошибки (".$title.")\n", Console::FG_YELLOW));

        foreach ($errors as $error) {
            $this->stdout($this->ansiFormat($error."\n", Console::FG_RED));
        }
        
    }

    protected function _realImport()
    {
        /**
        * As example use url: https://www.mk.ru/rss/index.xml
        */

        /**
         * @var common\models\Sources $source
         */
        $sources = Sources::find()->all();
        $itemsCount = 0;
        $errorsCount = 0;

        foreach ($sources as $source)
        {
            $this->stdout("Начало импорта ".$source->name." (".$source->url.")\n");
            $data = $source->getNewsFromURL();
            $itemsCount += count($data['items']);
            $errorsCount += count($data['errors']);
            $this->displayErrors('#'.$source->id.' '.$source->name, $data['errors']);
            $this->stdout($this->ansiFormat("Добавлено ".$itemsCount." новостей\n", Console::FG_GREEN));
        }

        $this->stdout($this->ansiFormat("\n- - - - - - - - \nИмпорт завершен!\n ".$itemsCount." новостей, ".$errorsCount." ошибок\n", Console::FG_GREEN));


    }

    
} 
