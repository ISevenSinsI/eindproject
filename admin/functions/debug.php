<?php
	function debug($var,$die = false){
		echo "<pre>";
			print_r($var);
		echo "</pre>";

		if($die){
			die();
		}
	}

	function get_datetime_microseconds(){
		$micro_date = microtime();
		$date_array = explode(" ",$micro_date);
		$date = date("Y-m-d H:i:s",$date_array[1]);
		$datetime = $date . $date_array[0];

		return $datetime;
	}
?>