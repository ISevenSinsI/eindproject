<?php

class User extends DataMapper {

    var $table = 'users';
    
    var $has_one = array("role");
    
    var $has_many = array(
    );

    var $validation = array();

    function __construct($id = NULL) {
        parent::__construct($id);
    }

    function post_model_init($from_cache = FALSE) {
        
    }
}