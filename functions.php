<?php
/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 00:32
 */

function isLoggedIn() {
    $auth = new Auth();
    return $auth->logged_in();
}

function isStatusOnSchedule($result) {
    return (array_key_exists('status_text', $result) && $result['status_text'] == 'on-schedule' && !isset($result['id']));
}

function apiParams()
{
  return $_GET;
}
