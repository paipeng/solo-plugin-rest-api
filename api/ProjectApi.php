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
            if (isStatusOnSchedule($v)) {
                  return null;
            }
            //$tasks = $project->get_tasks();
            //var_dump($tasks);
            //$v->tasks = $tasks;

            return $v;

        } else {
            echo "error";
        }
    }

    static public function getItemsByProjectId($project_id, $item) {
        if (isLoggedIn()) {
            $project = new Project();
            $v = $project->get($project_id);
            if (isStatusOnSchedule($v)) {
                return null;
            }

            if ($item == "tasks") {
                $tasks = $project->get_tasks();
                return $tasks;
            } else if ($item == "client") {
                $client = new Client();
                return $client->get($v->client_id);

            } else if ($item == "files") {
                $file = new File();
                $file->project_id = $v->id;
                return $file->get();

            } else if ($item == "activities") {
                $activity = new Activity();
                $activity->project_id = $v->id;
                return $activity->get();

            } else if ($item == "note") {
                $projectNotes = new ProjectNotes();
                //var_dump($projectNotes->get($v->id));
                return $projectNotes->get($v->id);
            }
        } else {
            return null;
        }
    }

    static public function createProject() {
        if (isLoggedIn()) {
            $project = new Project();
            $project->import_parameters_exactly(apiHttpBody());
            return $project->save();
        }
    }
}
