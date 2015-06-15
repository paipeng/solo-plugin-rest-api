<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 15/06/15
 * Time: 22:45
 */
class TimeEntryApi
{
    public static function getTimeEntries() {
        if (isLoggedIn()) {
            $timeEntry = new TimeEntry();
            $v = $timeEntry->get();
            return $v;
        } else {
            return null;
        }
    }

    public static function getTimeEntryById($timeentry_id) {
        if (isLoggedIn()) {
            $timeEntry = new TimeEntry();
            $v = $timeEntry->get($timeentry_id);
            return $v;
        } else {
            return null;
        }
    }
}