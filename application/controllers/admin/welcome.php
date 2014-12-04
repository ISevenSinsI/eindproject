<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends Sessioned_Controller {

    public function index() {

        redirect("users");

        // $data = array(
        //     "page_title" => "Home",
        //     "submenu" => false,
        //     "view" => "calendar/index"
        // );

        // $this->load->view("page", $data);
    }

    public function keep_alive()
    {
    	$_SESSION["last_active"] = time();

    	echo $_SESSION["last_active"];
    }
}