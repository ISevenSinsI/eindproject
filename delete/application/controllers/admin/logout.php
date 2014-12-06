<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");

class Logout extends Sessioned_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->muser->logout();

        redirect("admin");
    }

}

