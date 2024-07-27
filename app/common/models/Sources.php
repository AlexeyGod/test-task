<?php

namespace common\models;

use yii\db\ActiveRecord;
use Exception;

Class Sources extends ActiveRecord {
    
   //'id' 
   //'name'
   //'url'
    static $newsClass = 'common\models\News';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {

        return [
            [['name','url'], 'required'],
            [['name','url'], 'safe'],
            
        ];

       
    }

    public function getNewsFromUrl()
    {
        $defaults = [
            CURLOPT_URL => $this->url,
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_DNS_USE_GLOBAL_CACHE => false,
            CURLOPT_SSL_VERIFYHOST => 0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
            CURLOPT_SSL_VERIFYPEER => 0, //unsafe, but the fastest solution for the error " SSL certificate problem, verify that the CA cert is OK"
            CURLOPT_COOKIE => 1,
        ];
        try {
            $ch = curl_init();
            curl_setopt_array($ch,  $defaults);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; rv:1.9.2.13) Gecko/20101203 MRA 5.7 (build 03796) Firefox/3.6.13');
            
            
            if (!$result = curl_exec($ch)) {
                trigger_error(curl_error($ch));
            }
        
            curl_close($ch);
            $result = simplexml_load_string($result);
            $result = json_decode(json_encode($result), true);
        }
        catch(Exception $e)
        {
            return ['items' => [], 'errors' => [$e->getMessage()]];
        }
        
        $errors = [];
        $items = [];

        foreach ($result['channel']['item'] as $key => $val)
        {
            $val['created_at'] = strtotime($val['pubDate']);
            unset($val['category'], $val['enclosure'], $val['pubDate']);

            $items[] = $val;
        
            if(trim($val['title']) == '') continue;
        
            $object = new self::$newsClass();
        
            $object->title = $val['title'];
            $object->source = $val['link'];
            $object->content = $val['description'];
            $object->created_at = $val['created_at'];

            try {
                $object->save();
            }
            catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        
            unset($object);
        }

        return ['items' => $result, 'errors' => $errors];
    }

}