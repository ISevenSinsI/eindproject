<?php
	// Check if action is posted to fetch ajax calls
	if(isSet($_POST["action"])){
		// Check for specific action
		if($_POST["action"] == "delete_product"){
			$id = $_POST["id"];
			$delete = delete_product($id);
		}
		if($_POST["action"] == "edit_product"){
			echo json_encode(edit_product($_POST));
		}
		if($_POST["action"] == "new_product"){
			echo json_encode(new_product($_POST));
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

	function get_all_products(){
		$db = login_sql();

		$sql = "
			SELECT *
				
			FROM
				`products`
			WHERE NOT
				`products`.`deleted`
		";
		
		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			$data[$row["id"]] = $row;
			$data[$row["id"]]["product"] = $row["product"];
		}


		return $data;
	}

	function get_all_factories(){
		$db = login_sql();

		$sql = "
			SELECT
				*
			FROM
				`factories`
			WHERE NOT
				`deleted`
		";

		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}

		return $data;
	}

	function new_user($data){
		d($data);
		$db = login_sql();

		$password = sha1($data["password"]);

		$sql = "
			INSERT INTO
				`users`(
					`username`,
					`password`,
					`initials`,
					`prefix`,
					`last_name`,
					`role_id`
				)
			VALUES (
				'{$data["username"]}',
				'{$password}',
				'{$data["initials"]}',
				'{$data["prefix"]}',
				'{$data["last_name"]}',
				'{$data["role_id"]}'
			)
		";

		;

		$query = mysqli_query($db,$sql);

		return true;
	}