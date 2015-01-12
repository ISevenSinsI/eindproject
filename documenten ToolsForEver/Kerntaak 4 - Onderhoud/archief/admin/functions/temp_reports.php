<?php

	function login_sql(){
		$link = mysqli_connect('localhost', 'root', '', 'toolsforever');

		//check if connection is success
		if(!$link){
			die('Connect Error: ' . mysqli_connect_errno());
		}
		else{
			return $link;
		}
	}


	

?>