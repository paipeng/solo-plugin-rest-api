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
                $v = $project->get("client_id = " . $client_id);
                return count($v)>0?$v:null;
            }
        } else {
            return null;
        }
    }

    static public function createClient() {
        if (isLoggedIn()) {
            $client = new SoloClient();
            $client->import_parameters_exactly(apiHttpBody());
            //$client->id = 0;
            return $client->save();
        }
    }
}