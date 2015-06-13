<?php

/**
 * Created by PhpStorm.
 * User: paipeng
 * Date: 13/06/15
 * Time: 14:16
 */


use phpSweetPDO\SQLHelpers\Basic as Helpers;

class SoloClient extends Client
{
    function table_name(){

        return Utils::from_camel_case('clients');
    }


    public function save(){
        $this->import_parameters();

        //unset params that aren't saved to the db
        $this->unset_param('primary_contact_name');
        $this->unset_param('primary_contact_image');

        //todo:the relationship between the model and the validator seems messy. Re-evaluate
        $this->import_parameters();
        $this->validate();

        if ($this->validation_passed()) {
            $is_insert = $this->is_new();

            //validate params. We can not save arrays, or objects to the db. It will throw a pdo error
            //so lets remove any invalid params
            foreach($this->params as $key => &$param){
                if(is_object($param) || is_array($param)){
                    unset($this->params[$key]);
                }
            }

            //todo: handle case when there are no params to save, (just return true)??
            if ($is_insert) {
                //if this model has a created date field, set it here
                $this->set('created_date', time());
                $sql = Helpers::insert($this->table, $this->params);


            } else {
                $id = isset($this->id) ? $this->id : $this->params['id'];
                $sql = Helpers::update($this->table, $this->params, "id = '" . $id . "'");
            }

            $this->log_sql($sql);
            $result = $this->db->execute($sql);

            //todo:should I clear the param s array after a save?

            if ($is_insert) {
                $this->id = $this->db->getLastInsertId();

                //todo: I would rather not return EVERYTHING to the client side. Only the fields it needs, i.e. the fields that have been html purified create a separate function that returns those parameters (or just the id if none exist). In each model I can do something like $this->add_processed_field('message')
                return $this->to_array();
            }
            else return $result;
        }
        else {
            return $this->validator->errors();
        }

    }

}