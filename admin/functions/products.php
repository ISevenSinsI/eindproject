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

	function new_product($data){

		/* safety */
		// foreach($data as $value){
		// 	htmlentities($value);
		// }

		$db = login_sql();

		$sql = "
			INSERT INTO
				`products`(
					`product`,
					`type`,
					`factory_id`,
					`buy_price`,
					`sell_price`
				)
			VALUES (
				'{$data["type"]}',
				'{$data["factory_id"]}',
				'{$data["buy_price"]}',
				'{$data["sell_price"]}'
			)
		";

		;

		$query = mysqli_query($db,$sql);

		return true;
	}

	function delete_product($id){
		$db = login_sql();

		$sql = "
			UPDATE
				`products`
			SET
				`deleted` = 1
			WHERE
				`id` = '{$id}'
		";

	
		$query = mysqli_query($db,$sql);

		return true;
	}

	function edit_product($data){
		$db = login_sql();

		$sql = "
			UPDATE
				`products`
			SET
				`product`	= '{$data["product"]}',
				`type` 	= '{$data["type"]}',
				`factory_id` 	= '{$data["factory_id"]}',
				`buy_price` = '{$data["buy_price"]}',
				`sell_price` 	= '{$data["sell_price"]}'
			WHERE
				`products`.`id` = 	'{$data["id"]}'
		";

		$query = mysqli_query($db,$sql);

		return true;
	}

	function get_product($id){
		$db = login_sql();

		$sql = "
			SELECT
				`products`.`id`,
				`products`.`product`,
				`products`.`type`,
				`products`.`factory_id`,
				`products`.`buy_price`, 
				`products`.`sell_price`
			FROM
				`products`
			WHERE
				`products`.`id` = '{$id}'
		";

		$query = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}	

		return $data;
	}