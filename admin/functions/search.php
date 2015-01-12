<?php
	if(isSet($_POST["action"])){
		if($_POST["action"] == "search"){
			$product_id = $_POST["product_id"];
			$location_id = $_POST["location_id"];

			echo json_encode(get_product_by_location($product_id, $location_id));
		}
		if($_POST["action"] == "change_stock"){
			$product_id = $_POST["product_id"];
			$location_id = $_POST["location_id"];
			$amount = $_POST["amount"];

			print_r(change_stock($product_id, $location_id, $amount));
		}
	}

	function login_sql(){
		$link = mysqli_connect('localhost', 'ruudvisser_ruud', 'toolsforever', 'ruudvisser_toolsforever');

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

		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			$data[$row["id"]] = $row;
			$data[$row["id"]]["location"] = $row["location"];
		}


		return $data;
	}


	function get_all_products(){
		$db = login_sql();

		$sql = "
			SELECT 
				*
			FROM
				`products`
			WHERE NOT
				`deleted`
		";
		
		$query = mysqli_query($db,$sql);

		$data = array();	

		while($row = mysqli_fetch_assoc($query)){
			$data[$row["id"]] = $row;
			$data[$row["id"]]["product"] = $row["product"];
		}

		return $data;
	}	

	function change_stock($product_id, $location_id, $amount){
		$db = login_sql();

		$sql = "
			SELECT
				*
			FROM
				`stock`
			WHERE
				`location_id` = '{$location_id}'
			AND
				`product_id` = '{$product_id}'
		";	

		$query = mysqli_query($db, $sql);

		if($query->num_rows > 0){
			$sql = "
				UPDATE
					`stock`
				SET
					`amount` = '{$amount}'
				WHERE
					`stock`.`location_id` = '{$location_id}'
				AND
					`stock`.`product_id` = '{$product_id}'
			";

			$query = mysqli_query($db, $sql);

			return true;
		} else {
			$sql = "
				INSERT INTO
					`stock`(
						`product_id`,
						`location_id`,
						`amount`
					)
				VALUES(
						'{$product_id}',
						'{$location_id}',
						'{$amount}'
					)
			";

			$query = mysqli_query($db, $sql);

			return true;
		}
	}

	function get_product_by_location($product_id, $location_id){
		$db = login_sql();

		$sql = "
			SELECT
				`amount`,
				`products`.`product`,
				`products`.`type`,
				`products`.`minimum_stock`,
				`products`.`sell_price`,
				`locations`.`location`,
				`factories`.`factory`
			FROM
				`stock`
			JOIN
				`products`
			ON
				`stock`.`product_id` = `products`.`id`
			JOIN
				`locations`
			ON
				`stock`.`location_id` = `locations`.`id`
			JOIN
				`factories`
			ON
				`products`.`factory_id` = `factories`.`id`
			WHERE
				`product_id` = '{$product_id}'
			AND
				`location_id` = '{$location_id}'
		";

		$query = mysqli_query($db,$sql);

		if($query->num_rows > 0){
			while($row = mysqli_fetch_assoc($query)){
				$data["product"]["id"] = $product_id;
				$data["product"]["name"] = $row["product"];
				$data["product"]["type"] = $row["type"];
				$data["product"]["minimum_stock"] = $row["minimum_stock"];
				$data["product"]["sell_price"] = number_format($row["sell_price"],2,",",".");
				$data["amount"] = $row["amount"];
				$data["location"]["id"] = $location_id;
				$data["location"]["name"] = $row["location"];
				$data["factory"] = $row["factory"];
			}
		} else {
			$sql = "
				SELECT
					`products`.`product`,
					`products`.`type`,
					`products`.`minimum_stock`,
					`products`.`sell_price`,
					`locations`.`location`,
					`factories`.`factory` 
				FROM
					`products`,
					`locations`,
					`factories`
				WHERE
					`products`.`id` = '{$product_id}'
				AND
					`locations`.`id` = '{$location_id}'
				AND
					`factories`.`id` = `products`.`factory_id`
			";


			$query = mysqli_query($db,$sql);

			while($row = mysqli_fetch_assoc($query)){
				$data["product"]["id"] = $product_id;
				$data["product"]["name"] = $row["product"];
				$data["product"]["minimum_stock"] = $row["minimum_stock"];
				$data["product"]["type"] = $row["type"];
				$data["product"]["sell_price"] = number_format($row["sell_price"],2,",",".");
				$data["location"]["id"] = $location_id;
				$data["location"]["name"] = $row["location"];
				$data["factory"] = $row["factory"];
				$data["amount"] = 0;
			}	
		}

		return $data;
	}
?>