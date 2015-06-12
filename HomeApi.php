<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 00:50
 */
class HomeApi
{
    static public function getHome()
    {
        echo 'Solo Rest API';
    }

    static public function getVersion() {
        return array('version' => '1.0');
    }

    static public function login() {
        $user = getApi()->invoke('/params.json', EpiRoute::httpGet);
        //var_dump($user);
        if( isset($user['username']) && isset($user['password'])) {

            $auth = new Auth();
            if ($auth->login($user["username"], $user["password"])) {
                return array('result' => '200 OK');
            }
        }
        return array('result' => "error");
    }

    static public function logout() {
        $auth = new Auth();
        $auth->logout();
        return array('result' => "200 OK");
    }
}
