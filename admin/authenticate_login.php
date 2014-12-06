<?php
	// Check if post sessions are set to prevent direct access via url
	if(isSet($_POST["email"]) && isSet($_POST["password"])){
		$email = $_POST["email"];
		$password = sha1($_POST["password"]);

		// Check login and return result
		echo json_encode(check_login($email, $password));
	} else {
		// Give message + redirect link that direct access is not allowed
		echo "Geen directe toegang toegestaan, keer terug naar de inlog pagina<br />";
		echo "<a href='../admin'>Terugkeren</a>";
		die();
	}

	function login_sql(){
		$link = mysqli_connect('localhost', 'root', '', 'toolsforever');

		return $link;
	}

	function check_login($email, $sha1_password){
		// Login to database
		$db = login_sql();

		$sql = "
			SELECT 
				*
			FROM
				`users`
			WHERE
				`email` = '{$email}'
			AND
				`password` = '{$sha1_password}'
		";

		$query = mysqli_query($db,$sql);

		// if user is found
		while($row = mysqli_fetch_assoc($query)){
			// Set user for check
			$user = $row;
		}

		// Check if user is set
		if(isSet($user)){
			// Set session
		    session_start();
			$_SESSION["user"] = $user;
			
			return "succeeded";
		} 
		// If not, false login attempt
		else {
			return "False login attempt";
		}
	}


?>