
<?php
	// Check if action is posted to fetch ajax calls
	if(isSet($_POST["action"])){
		// Check for specific action
		if($_POST["action"] == "delete_location"){
			$id = $_POST["id"];
			$delete = delete_location($id);
		}
		if($_POST["action"] == "edit_location"){
			echo json_encode(edit_location($_POST));
		}
		if($_POST["action"] == "new_location"){
			echo json_encode(new_location($_POST));
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

	function get_all_locations(){
		$db = login_sql();

		$sql = "
			SELECT *
				
			FROM
				`locations`
			WHERE NOT
				`locations`.`deleted`
		";

		// print_r($sql);
		// die;
		
		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			$data[$row["id"]] = $row;
			$data[$row["id"]]["location"] = $row["location"];
		}


		return $data;
	}

	function get_Location($id){
		$db = login_sql();

		$sql = "
			SELECT
				`locations`.`id`,
				`locations`.`location`
			FROM
				`locations`
			WHERE
				`locations`.`id` = '{$id}'
		";

		$query = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}	

		return $data;
	}

	function edit_location($data){
		$db = login_sql();

		$sql = "
			UPDATE
				`locations`
			SET
				`location`	= '{$data["location"]}'
			WHERE
				`id` = '{$data["id"]}'
		";
		$query = mysqli_query($db,$sql);

		return true;
	}

	function new_location($data){
		$db = login_sql();

		$sql = "
			INSERT INTO
				`locations`(
					`location`
				)
			VALUES (
				'{$data["name"]}'
			)
		";

		$query = mysqli_query($db,$sql);

		return true;
	}

	function delete_location($id){
		$db = login_sql();

		$sql = "
			UPDATE
				`locations`
			SET
				`deleted` = 1
			WHERE
				`id` = '{$id}'
		";

		

		$query = mysqli_query($db,$sql);

		return true;
	}


?>