<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 21:32
 */
class TaskApi
{
    static public function getTasks()
    {
        if (isLoggedIn()) {
            $task = new Task();
            $v = $task->get();
            return $v;
        } else {
            return null;
        }
    }

    static public function getTimeEntriesByTaskId($task_id, $item) {
        if (isLoggedIn()) {
            if ($item == "timeentries") {
                $timeEntry = new TimeEntry();
                $v = $timeEntry->get();

                foreach ($v as $timeEntry) {
                    if ($timeEntry['task_id'] == $task_id) {

                    }
                }
                return $v;
            }
        } else {
            return null;
        }
    }
}