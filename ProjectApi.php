<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 00:18
 */
class ProjectApi
{
    static public function getAllProjects()
    {
        if (isLoggedIn()) {
            $project = new Project();
            $v = $project->get();
            return $v;
        } else {
            echo "error";
        }
    }

    static public function getProjectById($project_id)
    {
        if (isLoggedIn()) {
            $project = new Project();
            $v = $project->get($project_id);

            $tasks = $project->get_tasks();
            //var_dump($tasks);
            $v->tasks = $tasks;

            return isStatusOnSchedule($v)?null:$v;

        } else {
            echo "error";
        }
    }
}