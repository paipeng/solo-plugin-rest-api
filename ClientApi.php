<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 12/06/15
 * Time: 21:23
 */



class ClientApi
{
    static public function getClients()
    {
        if (isLoggedIn()) {
            $client = new Client();
            $v = $client->get();
            return $v;
        } else {
            echo "error";
        }
    }

    static public function getClientById($client_id)
    {
        if (isLoggedIn()) {
            $client = new Client();
            $v = $client->get($client_id);
            if (isset($v['id'])) {
                return $v;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    static public function getProjectsByClientId($client_id, $item)
    {
        if (isLoggedIn()) {
            if ($item == "projects") {
                $project = new Project();
                $v = $project->get("client_id = 1");
                return $v;
            }
        } else {
            return null;
        }
    }
}