<?php  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include '../../config/db.php';
  
} else {

  include '../config/db.php';
  
}

if (isset($_POST["makeadd"])) {

	$makename = $db->real_escape_string($_POST["makename"]);

	$query = "SELECT * FROM make WHERE make_name = '$makename'";

	$check = $db->query($query);

	if ($check->num_rows > 0) {

    $res = array(
			"Error" => true,
			"Message" => "Make already exists." 
		);

		echo json_encode($res);
		
		exit();
  
  } else {

    $query = "INSERT INTO make (make_name) VALUES ('$makename')"; 

    $success = $db->query($query);

    if ($success) {

      $res = array(
        "Error" => false,
        "Message" => "Make added successfully." 
      );

      echo json_encode($res);
      
      exit();

    } else {

      $res = array(
        "Error" => true,
        "Message" => "Error adding make." 
      );

      echo json_encode($res);
      
      exit();
    }
  }
  
}

if (isset($_POST["makeupdate"])) {
  
  $make_id = $db->real_escape_string($_POST["makeid"]);
  $make_name = $db->real_escape_string($_POST["makename"]);
  
  $current_make_details = $db->query("SELECT * FROM make WHERE id = '$make_id'");

  $current_make_details = $current_make_details->fetch_array();

  $check_name = $db->query("SELECT * FROM make WHERE make_name = '$make_name'");

  if ($check_name->num_rows > 0 && $current_make_details["make_name"] != $make_name) {
  
    $res = array(
      "Error" => true,
      "Message" => "A make with that name already exists." 
    );

    echo json_encode($res);

    exit();

  } else {

    $update_query = "UPDATE make SET make_name = '$make_name' WHERE id = '$make_id'";

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
        "Message" => "Error updating the make information. Please try again." 
      );

      echo json_encode($res);
      
      exit();
    }
  
  }

}

if (isset($_POST["deletemake"])) {
  
  $make_id = $db->real_escape_string($_POST["makeid"]);

  $query = "DELETE FROM make WHERE id = '$make_id'";

  $execute = $db->query($query);

  if ($execute) {

    $res = array(
      "Error" => false,
      "Message" => "Make deleted successfully." 
    );

    echo json_encode($res);
    
    exit();

  } else {

    $res = array(
      "Error" => true,
      "Message" => "Error deleting make. Restricted by relation to models." 
    );

    echo json_encode($res);
    
    exit();
  }
}

function get_car_makes() {
	global $db;

	$sql = "SELECT * FROM make";

	$results = $db->query($sql);

	return $results;
	
	exit();
		
}




?>