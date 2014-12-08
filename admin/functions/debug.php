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

	function get_full_url(){
		$full_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		return $full_url;
	}

	function translate($string){
		 switch($string){
		 	case "users":			return "Gebruikers";	break;
		 	case "locations":		return "Locaties";		break;
		 	case "products":		return "Artikelen";		break;
		 	case "administration":	return "Administratie";	break;
		 	case "stock":			return "Voorraad";		break;
		 	case "overview.php": 	return "Overzicht";		break;
		 	case "details.php": 	return "Details"; 		break;
		 	case "edit.php":		return "Wijzigen";		break;
		 	case "add.php":			return "Toevoegen";		break;
		 }
	}

	function breadcrumb(){
		$url = $_SERVER["REQUEST_URI"]; 
		$explode = explode("/", $url);
        
        $action = explode("?", array_pop($explode))[0];
        $action_display = translate($action);

        $module = array_pop($explode);
        $module_display = translate($module);

        $full_url = get_full_url();
        $explode = explode($module, $full_url);

        $data = array();

        $data["module"]["display"] = $module_display;
        $data["module"]["link"] = $explode[0] . $module;
        $data["action"]["display"] = $action_display;
        $data["action"]["link"] = $explode[0] . $module . "/" . $action;        

        return $data;
	}

	function page_name()
	{
		$url = $_SERVER["REQUEST_URI"]; 
        $explode = explode("/", $url);

        $last = count($explode) - 2;

        $current_page = $explode[$last];

        return $current_page;	
	}
?>