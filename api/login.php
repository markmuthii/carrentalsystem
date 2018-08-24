<?php 

if (isset($_POST["login"])) {

	session_start();

	require_once "../config/db.php";

	$username = $db->real_escape_string($_POST["username"]);
	$password = $db->real_escape_string($_POST["password"]);

	$sql = $db->query("SELECT * FROM users WHERE username = '$username'");

	if ($sql->num_rows > 0) {

		$user = $sql->fetch_array();

		if (password_verify($password, $user["password"])) {

			$_SESSION["firstname"] = $user["fname"];
			$_SESSION["lastname"] = $user["lname"];
			$_SESSION["user_id"] = $user["user_id"];
			$_SESSION["username"] = $user["username"];
			$_SESSION["email"] = $user["email"];
			$_SESSION["phonenumber"] = $user["phonenumber"];
			$_SESSION["role"] = $user["role"];
			$_SESSION["companyid"] = $user["company_id"];

			
			$res = array(
				"Error" => false,
				"Message" => "Login successful.",
				"Role" => $_SESSION["role"] 
			);

			echo json_encode($res);

			exit();
		}else{

			$res = array(
				"Error" => true,
				"Message" => "Invalid credentials."
			);

			echo json_encode($res);

			exit();
		}
		
	}else{

		$res = array(
			"Error" => true,
			"Message" => "Invalid credentials."
		);

		echo json_encode($res);

		exit();
	}

}else{
	header("Location: ../");
	exit();
}

?>