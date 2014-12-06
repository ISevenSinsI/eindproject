<?php

if (!defined("BASEPATH"))
    exit("No direct script access allowed");



class Sessioned_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model(array("muser", "mrole"));
        if (!$this->muser->is_logged_in())
        {
            if ($this->input->is_ajax_request())
            {
                FlashNotice::add("Your session has timed out! You will be redirected to the login page.", "error");
                echo FlashNotice::to_json(-1);
                exit();
            }
            else
            {
                
                if(isSet($_SERVER["REDIRECT_QUERY_STRING"]))
                {
                    $_SESSION["redirect_string"] = $_SERVER["REDIRECT_QUERY_STRING"];    
                }
                else
                {
                    $_SESSION["redirect_string"] = "";
                }
                
                redirect("login");
            }
        }

        $_SESSION["last_active"] = time();
    }

}