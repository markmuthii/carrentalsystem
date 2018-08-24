<?php 

if (isset($_POST["signup"])) {
	session_start();

	require_once "../config/db.php";

	$firstname = $db->real_escape_string($_POST["firstname"]);
	$lastname = $db->real_escape_string($_POST["lastname"]);
	$email = $db->real_escape_string($_POST["email"]);
	$phonenumber = $db->real_escape_string($_POST["phonenumber"]);
	$username = $db->real_escape_string($_POST["username"]);
	$password = $db->real_escape_string($_POST["password"]);

	$check_email = $db->query("SELECT * FROM users WHERE email = '$email'");

	if ($check_email->num_rows > 0) {

		$res = array(
			"Error" => true,
			"Message" => "Please use a different email." 
		);

		echo json_encode($res);

		exit();

	}else{

		$check_username = $db->query("SELECT * FROM users WHERE username = '$username'");

		if ($check_username->num_rows > 0) {

			$res = array(
				"Error" => true,
				"Message" => "Please use a different username." 
			);

			echo json_encode($res);
			
			exit();

		}else{

			$hashPass = password_hash($password, PASSWORD_DEFAULT);

			$signup_query = "INSERT INTO users (fname, lname, email, phonenumber, username, password) VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$username', '$hashPass')"; 

			$signup = $db->query($signup_query);

			if ($signup) {

				$res = array(
					"Error" => false,
					"Message" => "Signup successful." 
				);

				echo json_encode($res);
				
				exit();
			}else{
				$res = array(
					"Error" => true,
					"Message" => "Error signing you up. Please try again." 
				);

				echo json_encode($res);
				
				exit();
			}
		}
	}
} else {

	header("Location: ../");

	exit();

}


?>