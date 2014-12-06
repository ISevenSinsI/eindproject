<?php

function is_logged_in() {
    if (isSet($_SESSION["user"]["id"]) && (int) $_SESSION["user"]["id"] > 0) {
        return true;
    }
    return false;
}

function get_permissions() {

	$user_rules = array(
		"users" => array("index","details"),
		"consumptions" => array("index","details"),
		"rooms" => array("index","details"),
		"customers" => array("index","details"),
		"appointments" => array("index","details"),
		"calendar" => array("index"),
		"holidays" => array("index"),
	);

	return array(
		// Rol ID 1 - Beheerder
		1 => array(
			"users" => array("*"),
			"consumptions" => array("*"),
			"rooms" => array("*"),
			"customers" => array("*"),
			"appointments" => array("*"),
			"calendar" => array("*"),
			"holidays" => array("*"),
			"invoices" => array("*"),
		),
		// Rol ID 2 - Personeelslid
		2 => $user_rules,
		// Rol ID 3 - Uitzendkracht
		3 => $user_rules
	);





}

function is_authorized( $method ) {

	$permission_array = get_permissions();

	// Get permisison keys
	$class = reset( explode("::", $method ) );
	$method = end( explode("::", $method ) );

	// Make them lower case
	$class = strtolower( $class );
	$method = strtolower( $method );

	$role_id = $_SESSION["user"]["role_id"];

	// Check for permissions
	$has_permission = false;
	if ( isset( $permission_array[$role_id] ) ) {
		if ( isset( $permission_array[$role_id][$class] ) ) {
			$has_permission = in_array("*", $permission_array[$role_id][$class] );

			if(!$has_permission)
			{
				$has_permission = in_array( $method, $permission_array[$role_id][$class] );
			}
		}
	}

	return $has_permission;

}

function check_permissions( $method ) {
	
	if ( !is_authorized( $method ) ) {
		$CI =& get_instance();

		if ( $CI->input->is_ajax_request() ) {
			echo json_encode( array(
				"success" => "false",
				"error" => "U heeft geen rechten tot deze actie"
			) );
		}
		else {
			redirect();
		}
	}
}

function build_permission_array( $method ) {
	// Get permisison keys
	$class = reset( explode( "::", $method ) );
	$method = end( explode( "::", $method ) );

	// Make them lower case
	$class = strtolower( $class );
	$method = strtolower( $method );


	$class_name = $class;
	$class_methods = get_class_methods( $class_name );
	echo '"'.$class_name.'" => array(';
	$add_before = false;
	foreach ( $class_methods as $class_method ) {
		if ( $class_method != "__construct" && $class_method != "get_instance" ) {
			if ( $add_before ) {
				echo ",";
			}
			echo '"'.$class_method.'"';

			$add_before = true;
		}


	}
	echo '),';
	die();
}


?>