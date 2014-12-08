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
				`users`.`name` AS `name`,
				`users`.`email`,
				`users`.`phone`,
				`users`.`city`,
				`roles`.`name` AS `role`
			FROM
				`users`
			JOIN
				`roles`
			ON
				`users`.`role_id` = `roles`.`id`
			WHERE
				`users`.`deleted` = '0000-00-00 00:00:00.000000'
		";
		
		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			$data[$row["id"]] = $row;
			$data[$row["id"]]["name"] = $row["name"];
		}


		return $data;
	}

	function delete_user($id){
		$db = login_sql();

		// $datetime = get_datetime_microseconds();
		$datetime = date("Y-m-d H:i:s");

		$sql = "
			UPDATE
				`users`
			SET
				`deleted` = '{$datetime}'
			WHERE
				`id` = '{$id}'
		";

		debug($sql);

		$query = mysqli_query($db,$sql);

		return true;
	}

	function get_user($id){
		$db = login_sql();

		$sql = "
			SELECT
				`users`.`id`,
				`users`.`name` AS `name`,
				`users`.`email`,
				`users`.`phone`,
				`users`.`address`,
				`users`.`zipcode`,
				`users`.`city`,
				`users`.`country`,
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
				`name`		=	'{$data["name"]}',
				`email` 	= 	'{$data["email"]}',
				`role_id` 	= 	'{$data["role_id"]}',
				`phone` 	= 	'{$data["phone"]}',
				`address` 	= 	'{$data["address"]}',
				`city` 		= 	'{$data["city"]}',
				`country` 	= 	'{$data["country"]}'
			WHERE
				`id` = '{$data["role_id"]}'
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
					`name`,
					`password`,
					`email`,
					`role_id`,
					`phone`,
					`address`,
					`city`,
					`country`
				)
			VALUES (
				'{$data["name"]}',
				'{$password}',
				'{$data["email"]}',
				'{$data["role_id"]}',
				'{$data["phone"]}',
				'{$data["address"]}',
				'{$data["city"]}',
				'{$data["country"]}'
			)
		";

		$query = mysqli_query($db,$sql);

		return true;
	}
?>