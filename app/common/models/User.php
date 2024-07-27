<?php

namespace common\models;
use yii\web\IdentityInterface;

Class User  implements IdentityInterface {
    
   /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id=1)
    {
        return 1;
    }

    public static function findIdentityByAccessToken($token = '', $type = null)
    {
        return true;
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return 1;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return 1;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }


}