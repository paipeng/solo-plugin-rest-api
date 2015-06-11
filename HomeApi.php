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
}