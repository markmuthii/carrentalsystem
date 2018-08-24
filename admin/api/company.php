<?php  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	include '../../config/db.php';

} else {

	include '../config/db.php';

}

if (isset($_POST["companyadd"])) {

	$companyname = $db->real_escape_string($_POST["companyname"]);

	$query = "SELECT * FROM car_rental_company WHERE name = '$companyname'";

	$check = $db->query($query);

	if ($check->num_rows > 0) {

    $res = array(
			"Error" => true,
			"Message" => "A company with that name already exists." 
		);

		echo json_encode($res);
		
		exit();
  
  } else {

    $query = "INSERT INTO car_rental_company (name) VALUES ('$companyname')"; 

    $success = $db->query($query);

    if ($success) {

      $res = array(
        "Error" => false,
        "Message" => "Company added successfully." 
      );

      echo json_encode($res);
      
      exit();

    } else {

      $res = array(
        "Error" => true,
        "Message" => "Error adding company." 
      );

      echo json_encode($res);
      
      exit();
    }
  }
}

if (isset($_POST["companyupdate"])) {
  
  $company_id = $db->real_escape_string($_POST["companyid"]);
  $company_name = $db->real_escape_string($_POST["companyname"]);
  
  $current_company_details = $db->query("SELECT * FROM car_rental_company WHERE id = '$company_id'");

  $current_company_details = $current_company_details->fetch_array();

  $check_name = $db->query("SELECT * FROM car_rental_company WHERE name = '$company_name'");

  if ($check_name->num_rows > 0 && $current_company_details["name"] != $company_name) {
  
    $res = array(
      "Error" => true,
      "Message" => "A company with that name already exists." 
    );

    echo json_encode($res);

    exit();

  } else {

    $update_query = "UPDATE car_rental_company SET name = '$company_name' WHERE id = '$company_id'";

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
        "Message" => "Error updating the company information. Please try again." 
      );

      echo json_encode($res);
      
      exit();
    }
  
  }

}

if (isset($_POST["deletecompany"])) {
  
  $company_id = $db->real_escape_string($_POST["companyid"]);

  $query = "DELETE FROM car_rental_company WHERE id = '$company_id'";

  $execute = $db->query($query);

  if ($execute) {

    $res = array(
      "Error" => false,
      "Message" => "Company deleted successfully." 
    );

    echo json_encode($res);
    
    exit();

  } else {

    $res = array(
      "Error" => true,
      "Message" => "Error deleting company." 
    );

    echo json_encode($res);
    
    exit();
  }
}

if (isset($_POST["contactsupdate"])) {
  
  $facebook = $db->real_escape_string($_POST["facebook"]);
  $twitter = $db->real_escape_string($_POST["twitter"]);
  $instagram = $db->real_escape_string($_POST["instagram"]);
  $email = $db->real_escape_string($_POST["email"]);
  $phonenumber = $db->real_escape_string($_POST["phonenumber"]);
  $googleplus = $db->real_escape_string($_POST["googleplus"]);
  $about = $db->real_escape_string($_POST["about"]);
  $terms = $db->real_escape_string($_POST["terms"]);
  $privacy = $db->real_escape_string($_POST["privacy"]);
  
  $update_query = "UPDATE company 
                   SET facebook = '$facebook', 
                       twitter = '$twitter', 
                       instagram = '$instagram', 
                       email = '$email',
                       phonenumber = '$phonenumber',
                       googleplus = '$googleplus',
                       about = '$about',
                       terms = '$terms',
                       privacy = '$privacy'";

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
      "Message" => "Error updating the company information. Please try again." 
    );

    echo json_encode($res);
    
    exit();
  }
  
}

function get_company_contact_about() {

  global $db;

	$sql = "SELECT * FROM company";

  $results = $db->query($sql);
  
  $results = $results->fetch_array();

  return $results;
    
	exit();
}


function get_companies() {

	global $db;

	$sql = "SELECT * FROM car_rental_company";

	$results = $db->query($sql);

    return $results;
    
	exit();
		
}




?>