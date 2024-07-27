<?php

namespace frontend\tests\unit\models;

use common\models\News;
use common\models\Sources;

/**
 * Login form test
 */
class SourcesAndNewsTest extends \Codeception\Test\Unit 
{
    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    public function testSourceCorrect()
    {
        $model = new Sources([
            'name' => 'mk all news',
            'url' => 'https://www.mk.ru/rss/news/index.xml',
        ]);

        verify($model->validate())->true();
    }

    public function testNewsCorrect()
    {
        $model = new News([
            'title' => 'Some title',
            'content' => 'Some text content',
            'source' => 'https://www.mk.ru/rss/news/index.xml',
            'created_at' => 15651561616
        ]);

        verify($model->validate())->true();
    }


}
