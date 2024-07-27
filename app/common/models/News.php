<?php

namespace common\models;

use yii\db\ActiveRecord;
use Exception;

Class News extends ActiveRecord {
    
    //public $title;
    //public $content;
    //public $source;
    //public $created_at;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'source', 'created_at'], 'required'],
            [['title', 'source', 'content'], 'string'],
            ['created_at', 'integer']
        ];
       
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function getDate()
    {
        return date("H:i d.m.y", strtotime($this->created_at));
    }

    public function beforeSave($insert)
    {
        $this->created_at = (is_integer($this->created_at) ? date('Y-m-d H:i:s', $this->created_at) : $this->created_at);
        return parent::beforeSave($insert);
    }
}