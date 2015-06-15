<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 15/06/15
 * Time: 22:02
 */
class ActivityApi
{
    public static function getActivities() {
        if (isLoggedIn()) {
            $activity = new Activity();
            $v = $activity->get();
            return $v;
        } else {
            return null;
        }
    }

    public static function getActivityById($activity_id) {
        if (isLoggedIn()) {
            $activity = new Activity();
            $v = $activity->get(' where activity.id = ' . $activity_id);
            return $v;
        } else {
            return null;
        }
    }

}