<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	include '../../config/db.php';

} else {

	include '../config/db.php';

}

if (isset($_POST["adminadd"])) {
	session_start();

	require_once "../../config/db.php";

	$firstname = $db->real_escape_string($_POST["firstname"]);
	$lastname = $db->real_escape_string($_POST["lastname"]);
	$email = $db->real_escape_string($_POST["email"]);
	$phonenumber = $db->real_escape_string($_POST["phonenumber"]);
	$username = $db->real_escape_string($_POST["username"]);
	$password = $db->real_escape_string($_POST["password"]);
	$companyid = $db->real_escape_string($_POST["companyid"]);
	$adminrole = $db->real_escape_string($_POST["adminrole"]);

	$check_email = $db->query("SELECT * FROM users WHERE email = '$email'");

	if ($check_email->num_rows > 0) {

		$res = array(
			"Error" => true,
			"Message" => "Please use a different email." 
		);

		echo json_encode($res);

		exit();

	} else {

		$check_username = $db->query("SELECT * FROM users WHERE username = '$username'");

		if ($check_username->num_rows > 0) {

			$res = array(
				"Error" => true,
				"Message" => "Please set a different username." 
			);

			echo json_encode($res);
			
			exit();

		} else {

			$hashPass = password_hash($password, PASSWORD_DEFAULT);

			// $signup_query = ($adminrole == "admin") ? 
			// "INSERT INTO users (fname, lname, email, phonenumber, username, password, company_id, role) 
			// VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$username', '$hashPass', '$companyid', '$adminrole')"
			// :
			// "INSERT INTO users (fname, lname, email, phonenumber, username, password, role) 
			// VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$username', '$hashPass', '$adminrole')"; 
			if ($adminrole == "admin") {
				$signup_query = "INSERT INTO users (fname, lname, email, phonenumber, username, password, company_id, role) VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$username', '$hashPass', '$companyid', '$adminrole')";
			} else {
				$signup_query = "INSERT INTO users (fname, lname, email, phonenumber, username, password, role) VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$username', '$hashPass', '$adminrole')";
			}

			$adminAdded = $db->query($signup_query);

			if ($adminAdded) {

				$res = array(
					"Error" => false,
					"Message" => "Admin added successfully." 
				);

				echo json_encode($res);
				
				exit();
			} else {
				$res = array(
					"Error" => true,
					"Message" => "Error adding admin. Please try again." 
				);

				echo json_encode($res);
				
				exit();
			}
		}
	}
}

if (isset($_POST["adminedit"])) {
  
  $admin_id = $db->real_escape_string($_POST["adminid"]);

  $update_query = "UPDATE users SET role = 'client' WHERE user_id = '$admin_id'";

  $update = $db->query($update_query);

  if ($update) {

    $res = array(
      "Error" => false,
      "Message" => "Update successful." 
    );

    echo json_encode($res);
    
    exit();
    
  } else {

    $res = array(
      "Error" => true,
      "Message" => "Error updating the admin role to client. Please try again." 
    );

    echo json_encode($res);
    
    exit();
  }

}


function get_admins() {

	global $db;

  $sql = "SELECT 
            u.*, 
            c.name AS company
          FROM users u
          INNER JOIN car_rental_company c
          ON u.company_id = c.id
          WHERE u.role = 'admin'";

	$results = $db->query($sql);

	return $results;

	exit();
		
}

function get_super_admins() {

	global $db;

  $sql = "SELECT 
            u.*
          FROM users u
          WHERE u.role = 'su'";

	$results = $db->query($sql);

	return $results;

	exit();
		
}

function get_clients() {

	global $db;

  $sql = "SELECT 
            u.*
          FROM users u
          WHERE u.role = 'client'";

	$results = $db->query($sql);

	return $results;

	exit();
		
}


?>