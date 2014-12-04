<?php

class MLogin extends CI_Model
{	
	public function check_login($email, $password){
		$user = new User();
		$user->where("email",$email)->get();

		// Check if user is found
		if($user->id < 1 && $user->username == ""){
			// If user id and username not set after search return false;
			return "E-mail foutief";
		} else {
			// if user found check password
			if($user->password === $password){
				return $this->do_login($user->id);
			} else {
				return "Wachtwoord foutief";
			}
		}
	}

	public function do_login($user_id){
		$user = new User($user_id);
		$_SESSION["user"] = $user->to_array();
		return true;
	}
}