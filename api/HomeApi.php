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
        echo '<h1>Solo Rest API</h1>';

        showApis();
    }

    static public function getVersion() {
        return array('version' => '1.0');
    }

    static public function login() {
        $user = getApi()->invoke('/postParams.json', EpiRoute::httpGet);
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


    static public function getUser() {
        $user = isLoggedIn();
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }
}
