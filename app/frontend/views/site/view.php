<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = $model->title;

$this->params['breadcrumbs'][] = $this->title;

        echo '<h1>'.Html::encode($this->title).'</h1>
        <div class="view-block">
            <div class="row">
                <div class="col-xs-12 date">'.$model->date.'</div>
                <div class="col-xs-12 content">'.$model->content.'</div>
            </div>
            <div class="row">
                <div class="col-xs-12 source">Источник: '.Html::a($model->source, $model->source).'</div>
            </div>
             <div class="row">
                <div class="col-xs-12 link"><a href="javascript:history.back()">◄ Назад</a></div>
            </div>
        </div>';  