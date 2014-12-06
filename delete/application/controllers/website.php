<?php

class Website extends CI_Controller
{
	public function index(){
		$data = array(
			// Get locations
		);

		$this->load->view("base/vhomepage", $data);
	}
}