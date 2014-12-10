<?php
//functions list


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



	function getPerLocation()
	{
	$db = login_sql();

		$sql = "
			SELECT `products`.product, `products`.`id` AS `product_id`, `locations`.location,   `locations`.id AS `location_id`, `products`.type, `factories`.factory, `stock`.amount, `products`.buy_price, `products`.sell_price
			FROM `products`
			LEFT JOIN `stock`
			ON `products`.id = `stock`.product_id
			LEFT JOIN `locations`
			ON `stock`.location_id = `locations`.id
			LEFT JOIN `factories`
			ON `products`.id = `factories`.id
			WHERE NOT `products`.deleted
			AND NOT `locations`.deleted

		";
		
		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){
			if(!isSet($data[$row["location_id"]])){
				$data[$row["location_id"]] = array(
					"name" => $row["location"],
					"total_buy_price" => 0,
					"total_sell_price" => 0,
					"products" => array(),
 				);
			}

			if(!isSet($data[$row["location_id"]]["products"][$row["product_id"]])){
				$data[$row["location_id"]]["products"][$row["product_id"]] = array(
					"name"	=> $row["product"],
					"type"	=>	$row["type"],
					"sell_price" => $row["sell_price"],
					"buy_price" => $row["buy_price"],
					"amount"	=>	$row["amount"],
					"factory" 	=> 	$row["factory"],

					"total_sell_price" => 0,
					"total_buy_price" => 0,
				);				
			}

			$total_buy_price = $row["amount"] * $row["buy_price"];
			$total_sell_price = $row["amount"] * $row["sell_price"];

			$data[$row["location_id"]]["total_buy_price"] += $total_buy_price;
			$data[$row["location_id"]]["total_sell_price"] += $total_sell_price;

			$data[$row["location_id"]]["products"][$row["product_id"]]["total_buy_price"] += $total_buy_price;
			$data[$row["location_id"]]["products"][$row["product_id"]]["total_sell_price"] += $total_sell_price;
		}
			

			echo "<pre>";
			print_r($data);
			echo "</pre>";
			die;

		return $data;
	}

	function order_list()
	{
		$db = login_sql();

		$sql = "
				SELECT `products`.*, `stock`.*
				FROm `products`
				LEFT JOIN `stock`
				ON `products`.id = `stock`.product_id
				WHERE `stock`.amount < `products`.minimum_stock";
	

		$query = mysqli_query($db,$sql);

		$data = array();

		while($row = mysqli_fetch_assoc($query)){

		}
		
		return $data;
	}
	



?>