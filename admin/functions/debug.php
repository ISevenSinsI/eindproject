<?php
	function debug($var,$die = false){
		echo "<pre>";
			print_r($var);
		echo "</pre>";

		if($die){
			die();
		}
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
		// Get url from base
		$url = $_SERVER["REQUEST_URI"]; 
		// explode path
		$explode = explode("/", $url);
	
		// Get last of array (i.e. 'edit.php?id=1') 
		// And delete query parameter        
        $action = explode("?", array_pop($explode))[0];
        // Translate action for display
        $action_display = translate($action);

        // Get last of >>remaining<< array (i.e. 'users')
        $module = array_pop($explode);
        // Translate module for display
        $module_display = translate($module); 

        $full_url = get_full_url();
        // Explode full url on the module you are on
        // To get the full defined href
        // I.e. 'http://boerenlevenerp.nl/users/edit.php?id=1'
        // Explode into 'http://boerenlevenerp.nl/users'
        $explode = explode($module, $full_url);

        $data = array();

        // Set module display name i.e. "Gebruikers"
        $data["module"]["display"] = $module_display;
    	// Make urls using the last explode + previous module explode
    	$data["module"]["link"] = $explode[0] . $module;
    	// Set action display name i.e. "Wijzigen"
        $data["action"]["display"] = $action_display;
        // Make urls using the last explode + previous module explode
        $data["action"]["link"] = $explode[0] . $module . "/" . $action;        

        return $data;
	}
?>