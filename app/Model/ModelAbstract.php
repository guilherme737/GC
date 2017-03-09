<?php

abstract class ModelAbstract extends \ActiveRecord\Model{

    public static function collection_to_array(){

        $results = call_user_func_array('static::all', func_get_args());

        if( is_array($results) ){

            $results = array_map(function($item){
                return $item->to_array();
            }, $results);

            return $results;

        }else{
            return [$results->to_array()];
        }

    }

}