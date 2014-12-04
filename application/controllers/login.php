<?php

class Login extends CI_Controller
{
	public function __construct(){
		parent::__construct();

		$this->load->model("mlogin");
	}


	public function index(){

			$data = array(
				"page_title" => "Inloggen",
				"view_content" => "login/base"
			);

			$this->load->view("vpage", $data);
		
	}

	public function do_login(){
		$email = $this->input->post("email");
		$password = sha1($this->input->post("password"));

		$attempt = $this->mlogin->check_login($email, $password);

		if($attempt === true){
			redirect("products");
		} else {
			echo json_encode($attempt);
		}
	}
}