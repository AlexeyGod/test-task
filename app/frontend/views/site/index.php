<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Новости';


echo '<div class="news-container">';

foreach ($news as $item) { 
echo '<div class="row">
        <div class="col-xs-12 head">'.$item->title.'</div>
        <div class="col-xs-12 date">'.$item->date.'</div>
        <div class="col-xs-12 content">'.$item->content.'</div>
        <div class="col-xs-12 source">Источник: '.Html::a(substr($item->source, 0, 50).'...', $item->source).'</div>
        <div class="col-xs-12 link">'.Html::a("Читать ►", '/'.$item->id).'</div>
    </div>';
    } 
    
    echo LinkPager::widget([
        'pagination' => $pages,
    ]); 
    
    ?>
</div>
