<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends Sessioned_Controller {
	public function __construct()
	{
		parent::__construct();

		$this->load->model('muser');
	}

  public function index()
    {
        check_permissions(__METHOD__);

        $data = array(
            "page_title" => "Gebruikers",
            "view" => "users/index",
            "submenu" => "users",
            "breadcrumb" => array(
                array("url" => "users", "title" => "Gebruikers"),
            ),
            "users" => $this->muser->get_all(),
        );

        $this->load->view("page", $data);
    }

    public function details($id = "")
    {
        check_permissions(__METHOD__);

        if($id == "") { redirect(); }

        $user = $this->muser->get($id);

        $data = array(
            "page_title" => "Gebruiker Details",
            "view" => "users/details",
            "submenu" => "users",
            "user" => $user,
            "breadcrumb" => array(
                array("url" => "users", "title" => "Gebruiker"),
                array("url" => "users/details/" . $id, "title"=> $user["name"] . " - Details"),
            ),
            "roles" => $this->mrole->get_all(),
        );

        $this->load->view("page", $data);
    }

    public function password($id){

        if($id == "") { redirect(); }

        // if not admin
        if($_SESSION['user']['role_id'] != 1){

            // if employee id != session employee id
            if($_SESSION['user']['id'] != $id){
                redirect();
            }

        }

        $user = $this->muser->get($id);

        $data = array(
            "page_title" => "Gebruiker Wachtwoord Aanpassen",
            "view" => "users/password",
            "submenu" => "users",
            "user" => $user,
            "breadcrumb" => array(
                array("url" => "users", "title" => "Gebruiker"),
                array("url" => "users/details/" . $id, "title"=> $user["name"] . " - Wachtwoord aanpassen"),
            )
        );

        $this->load->view("page", $data);
    }
    public function save_password(){

        $user_id = $this->input->post('id');
        $password = $this->input->post('password');

        $saved = $this->muser->store_password($user_id, $password);

        if($saved){
            // Success
            redirect("users");
        }
        else {
            // Failed
            redirect("users");
        }
    }
    public function add()
    {

        check_permissions(__METHOD__);

        $data = array(
            "page_title" => "Gebruikers Toevoegen",
            "view" => "users/store",
            "submenu" => "users",
            "breadcrumb" => array(
                array("url" => "users", "title" => "Gebruikers"),
                array("url" => "users/add/", "title"=> "Toevoegen"),
            ),
            "roles" => $this->mrole->get_all(),
        );

        $this->load->view("page", $data);
    }

    public function edit($id = "")
    {
        check_permissions(__METHOD__);

        if($id == "") { redirect(); }

        $user = $this->muser->get($id);

        $data = array(
            "page_title" => "Gebruikers Aanpassen",
            "view" => "users/store",
            "submenu" => "users",
            "user" => $user,
            "breadcrumb" => array(
                array("url" => "users", "title" => "Gebruikers"),
                array("url" => "users/details/" . $id, "title"=> $user["name"] . " - Bewerken"),
            ),
            "roles" => $this->mrole->get_all(),
        );

        $this->load->view("page", $data);
    }   
    public function save()
    {
        $id = $this->input->post("id");
        $data = $this->input->post();

        $save = $this->muser->save($id, $data);

        if($save)
        {
            redirect("users/");
        }
        else
        {
            redirect("users/");
        }
    } 
    public function delete($id = "")
    {
        if($id != "")
        {   
            if($this->muser->delete($id)){
            redirect("users/");
            }
            // echo ($this->muser->delete($id)) ? 1 : 0;
        }
    }
}