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
			SELECT 
				`products`.*,
				`factories`.`factory`
			FROM
				`products`
			JOIN
				`factories`
			ON
				`products`.`factory_id` = `factories`.`id`
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

		$db = login_sql();

		$buy_price = str_replace(",",".",$data["buy_price"]);
		$sell_price = str_replace(",",".",$data["sell_price"]);

		$sql = "
			INSERT INTO
				`products`(
					`product`,
					`type`,
					`factory_id`,
					`minimum_stock`,
					`buy_price`,
					`sell_price`
				)
			VALUES (
				'{$data["product"]}',
				'{$data["type"]}',
				'{$data["factory_id"]}',
				'{$data["minimum_stock"]}',
				'{$buy_price}',
				'{$sell_price}'
			)
		";

		$query = mysqli_query($db,$sql);		

		$product_id = mysqli_insert_id($db);

		$locations = get_all_locations();

		$sql = "
			INSERT INTO
				`stock`(
					`location_id`,
					`product_id`,
					`amount`
				)
			VALUES

		";

		foreach($locations as $location_id => $location){
			$sql .= "('{$location_id}', '{$product_id}', '0'),";
		}

		$sql = rtrim($sql,",");
		
		$query = mysqli_query($db, $sql);

		return true;
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
				`minimum_stock` = '{$data["minimum_stock"]}',
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
				`products`.`sell_price`,
				`products`.`minimum_stock`,
				`factories`.`factory`
			FROM
				`products`
			JOIN
				`factories`
			ON
				`products`.`factory_id` = `factories`.`id`
			WHERE
				`products`.`id` = '{$id}'
		";

		$query = mysqli_query($db, $sql);

		while($row = mysqli_fetch_assoc($query)){
			$data = $row;
		}	

		return $data;
	}