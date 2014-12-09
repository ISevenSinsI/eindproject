<?php
	// Check if action is posted to fetch ajax calls
	if(isSet($_POST["action"])){
		// Check for specific action
		if($_POST["action"] == "delete_factory"){
			$id = $_POST["id"];
			$delete = delete_factory($id);
		}
		if($_POST["action"] == "edit_factory"){
			echo json_encode(edit_factory($_POST));
		}
		if($_POST["action"] == "new_factory"){
			echo json_encode(new_factory($_POST));
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

	function get_factory($id){
		$db = login_sql();

		$sql = "
			SELECT
				*
			FROM
				`factories`
			WHERE
				`id` = '{$id}'
		";	

		$query = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}

		return $data;
	}

	function delete_factory($id){
		$db = login_sql();

		$sql = "
			UPDATE
				`factories`
			SET
				`deleted` = 1
			WHERE
				`id` = {$id}
		";

		$query = mysqli_query($db,$sql);
	}

	function edit_factory($data){
		$db = login_sql();

		$sql = "
			UPDATE
				`factories`
			SET
				`factory` = '{$data["factory"]}',
				`phone` = '{$data["phone"]}'
			WHERE
				`id` = {$data["id"]}
		";	

		$query = mysqli_query($db,$sql);

		return true;
	}

	function new_factory($data){
		$db = login_sql();

		$sql = "
			INSERT INTO
				`factories`(
					`id`,
					`factory`,
					`phone`
				)
				VALUES(
					'{$data["id"]}',
					'{$data["factory"]}',
					'{$data["phone"]}'
				)
		";

		$query = mysqli_query($db,$sql);

		return true;
	}

?>