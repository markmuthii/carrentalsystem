<?php 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include '../config/db.php';
} else {
	include 'config/db.php';
}

if (isset($_POST["profileupdate"])) {


	$firstname = $db->real_escape_string($_POST["firstname"]);
	$lastname = $db->real_escape_string($_POST["lastname"]);
	$email = $db->real_escape_string($_POST["email"]);
	$phonenumber = $db->real_escape_string($_POST["phonenumber"]);
	$username = $db->real_escape_string($_POST["username"]);
	$current_password = $db->real_escape_string($_POST["currentpassword"]);
	$new_password = $db->real_escape_string($_POST["newpassword"]);
	$userid = $db->real_escape_string($_POST["userid"]);
  $changepass = $db->real_escape_string($_POST["changepass"]);
  
  $current_user_details = $db->query("SELECT * FROM users WHERE user_id = '$userid'");

  $current_user_details = $current_user_details->fetch_array();

  $check_email = $db->query("SELECT * FROM users WHERE email = '$email'");
  
  // $user = $check_email->fetch_array();

	if ($check_email->num_rows > 0 && $current_user_details["email"] != $email) {
    
      $res = array(
        "Error" => true,
        "Message" => "Please use a different email." 
      );
  
      echo json_encode($res);
  
      exit();

	} else {

    $check_username = $db->query("SELECT * FROM users WHERE username = '$username'");
    
    // $user = $check_username->fetch_array();

		if ($check_username->num_rows > 0 && $current_user_details["username"] != $username) {

			$res = array(
				"Error" => true,
				"Message" => "Please use a different username." 
			);

			echo json_encode($res);
			
			exit();

		} else {

      if ($current_password !== "") {

        if (password_verify($current_password, $current_user_details["password"])) {

          $hashPass = password_hash($new_password, PASSWORD_DEFAULT);
          $update_query = "UPDATE users SET fname = '$firstname', lname = '$lastname', email = '$email', phonenumber = '$phonenumber', username = '$username', password = '$hashPass' WHERE user_id = '$userid'";
        
        } else {

          $res = array(
            "Error" => true,
            "Message" => "Your password does not match." 
          );
    
          echo json_encode($res);
          
          exit();
        }
        
      } else {

        $update_query = "UPDATE users SET fname = '$firstname', lname = '$lastname', email = '$email', phonenumber = '$phonenumber', username = '$username'  WHERE user_id = '$userid'";
      
      }
      
			$update = $db->query($update_query);

			if ($update) {

				$_SESSION["firstname"] = $firstname;
				$_SESSION["lastname"] = $lastname;
				$_SESSION["username"] = $username;
				$_SESSION["email"] = $email;
				$_SESSION["phonenumber"] = $phonenumber;

				$res = array(
					"Error" => false,
					"Message" => "Update successful." 
				);

				echo json_encode($res);
				
				exit();
			} else {
				$res = array(
					"Error" => true,
					"Message" => "Error updating your information. Please try again." 
				);

				echo json_encode($res);
				
				exit();
			}
		}
	}
}

if (isset($_POST["deleteaccount"])) {

	$user_id = $db->real_escape_string($_POST["userid"]);

  $query = "DELETE FROM users WHERE user_id = '$user_id'";

  $execute = $db->query($query);

  if ($execute) {

    $res = array(
      "Error" => false,
      "Message" => "Account deleted successfully." 
		);
		
		session_unset();
		session_destroy();

    echo json_encode($res);
    
    exit();

  } else {

    $res = array(
      "Error" => true,
      "Message" => "Error deleting account." 
    );

    echo json_encode($res);
    
    exit();
  }
}


?>