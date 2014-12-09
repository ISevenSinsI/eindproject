<?php
	// Check if action is posted to fetch ajax calls
	if(isSet($_POST["action"])){
		// Check for specific action
		if($_POST["action"] == "delete_user"){
			$id = $_POST["id"];
			$delete = delete_user($id);
		}
		if($_POST["action"] == "edit_user"){
			echo json_encode(edit_user($_POST));
		}
		if($_POST["action"] == "new_user"){
			echo json_encode(new_user($_POST));
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

	function get_all_users(){
		$db = login_sql();

		$sql = "
			SELECT 
				`users`.`id`,
				`users`.`username`,
				`users`.`initials`,
				`users`.`prefix`,
				`users`.`last_name`, 
				`users`.`role_id`,
				`roles`.`name` AS `role`
			FROM
				`users`
			JOIN
				`roles`
			ON
				`users`.`role_id` = `roles`.`id`
			WHERE NOT
				`users`.`deleted`
		";
		
		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			$data[$row["id"]] = $row;
			$data[$row["id"]]["username"] = $row["username"];
		}


		return $data;
	}

	function delete_user($id){
		$db = login_sql();

		$sql = "
			UPDATE
				`users`
			SET
				`deleted` = 1
			WHERE
				`id` = '{$id}'
		";

		

		$query = mysqli_query($db,$sql);

		return true;
	}

	function get_user($id){
		$db = login_sql();

		$sql = "
			SELECT
				`users`.`id`,
				`users`.`username`,
				`users`.`initials`,
				`users`.`prefix`,
				`users`.`last_name`, 
				`roles`.`name` AS `role`
			FROM
				`users`
			JOIN
				`roles`
			ON
				`users`.`role_id` = `roles`.`id`
			WHERE
				`users`.`id` = '{$id}'
		";

		$query = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}	

		return $data;
	}

	function get_all_roles(){
		$db = login_sql();

		$sql = "
			SELECT
				*
			FROM
				`roles`
		";

		$query = mysqli_query($db, $sql);

		$data = array();
		while($row = mysqli_fetch_assoc($query)){
			$data[] = $row;
		}

		return $data;
	}

	function edit_user($data){
		$db = login_sql();

		$sql = "
			UPDATE
				`users`
			SET
				`username`	= '{$data["username"]}',
				`initials` 	= '{$data["initials"]}',
				`prefix` 	= '{$data["prefix"]}',
				`last_name` = '{$data["last_name"]}',
				`role_id` 	= '{$data["role_id"]}'
			WHERE
				`users`.`id` = 	'{$data["id"]}'
		";

		$query = mysqli_query($db,$sql);

		return true;
	}

	function new_user($data){
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

?>