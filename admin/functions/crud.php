<?php
	// General Create, Read, Update, Delete functions
	if(isSet($_POST["object"])){
		if(isSet($_POST["action"])){
			if($_POST["action"] == "create"){

			}
			if($_POST["action"] == "edit"){
			}
			if($_POST["action"] == "delete"){
				echo json_encode(delete_object($_POST));
			}
		}
	}

	function delete_object($data){
 		$db = login_sql();

		$datetime = date("Y-m-d H:i:s");
		
		$sql = "
			UPDATE
				`{$data["object"]}`
			SET
				`deleted` = '{$datetime}'
			WHERE
				`id` = '{$data['id']}'
		";

		
		$query = mysqli_query($db, $sql);

	}

	function debug($var,$die = false){
		echo "<pre>";
			print_r($var);
		echo "</pre>";

		if($die){
			die();
		}
	}

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