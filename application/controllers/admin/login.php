<?php

if ( !defined( "BASEPATH" ) )
    exit( "No direct script access allowed" );

class Login extends CI_Controller
{

    function __construct() {
        parent::__construct();
        $this->load->model("muser");
    }

    public function index() {
        if ( $this->muser->is_logged_in() ) {
            redirect("admin/users");
        }
        else {
            $data = array(
                "view" =>  "login/login"
            );
            $this->load->view("base/login", $data );
        }
    }

    public function check( $return_type = Return_type::JSON ) {

        if ( $this->muser->is_logged_in() ) {

            redirect("admin/users");
        }
        else {
            $username = $this->input->post("username");
            $password = $this->input->post("password");

            $data = array(
                "view" => "login/login",
                "error" => "Gebruikersnaam en of wachtwoord is incorrect."
            );

            if ( $this->muser->login( $username, $password ) ) {
                if ( isset( $_SESSION["redirect_string"] ) && $_SESSION["redirect_string"] != "") {
                    redirect( $_SESSION["redirect_string"] );
                }
                else {
                    redirect("admin/users");
                }
            }

            FlashNotice::add("Ongeldige gegevens", "error");
            $this->load->view("base/login", $data );
        }
    }

}
