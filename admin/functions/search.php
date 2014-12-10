<?php
	if(isSet($_POST["action"])){
		if($_POST["action"] == "search"){
			$product_id = $_POST["product_id"];
			$location_id = $_POST["location_id"];

			echo json_encode(get_product_by_location($product_id, $location_id));
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

	function get_product_by_location($product_id, $location_id){
		$db = login_sql();

		$sql = "
			SELECT
				`amount`,
				`products`.`product`,
				`locations`.`location`
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
			WHERE
				`product_id` = '{$product_id}'
			AND
				`location_id` = '{$location_id}'
		";

		$query = mysqli_query($db,$sql);
		$data = array();



		if($query->num_rows > 0){
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
		} else {
			$sql = "
				SELECT
					`products`.`product`,
					`locations`.`location`
				FROM
					`products`,
					`locations`
				WHERE
					`products`.`id` = '{$product_id}'
				AND
					`locations`.`id` = '{$location_id}'
			";

			$query = mysqli_query($db,$sql);

			while($row = mysqli_fetch_assoc($query)){
				$data["location"] = $row["location"];
				$data["product"] = $row["product"];				
				$data["amount"] = 0;
			}	
		}

		return $data;
	}
?>