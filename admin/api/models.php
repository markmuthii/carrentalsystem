<?php  

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include '../../config/db.php';
  
} else {

  include '../config/db.php';
  
}

if (isset($_POST["modelAdd"])) {

	$modelname = $db->real_escape_string($_POST["modelname"]);
	$makeid = $db->real_escape_string($_POST["makeid"]);

	$query = "SELECT * FROM model WHERE model_name = '$modelname'";

	$check = $db->query($query);

	if ($check->num_rows > 0) {

    $res = array(
			"Error" => true,
			"Message" => "Model already exists." 
		);

		echo json_encode($res);
		
		exit();
  
  } else {

    $query = "INSERT INTO model (model_name, make_id) VALUES ('$modelname', '$makeid')"; 

    $success = $db->query($query);

    if ($success) {

      $res = array(
        "Error" => false,
        "Message" => "Model added successfully." 
      );

      echo json_encode($res);
      
      exit();

    } else {

      $res = array(
        "Error" => true,
        "Message" => "Error adding model." 
      );

      echo json_encode($res);
      
      exit();
    }

  }
	
}

if (isset($_POST["modelupdate"])) {
  
  $model_id = $db->real_escape_string($_POST["modelid"]);
  $model_name = $db->real_escape_string($_POST["modelname"]);
  $make_id = $db->real_escape_string($_POST["makeid"]);
  
  $current_model_details = $db->query("SELECT * FROM model WHERE id = '$model_id'");

  $current_model_details = $current_model_details->fetch_array();

  $check_name = $db->query("SELECT * FROM model WHERE model_name = '$model_name'");

  if ($check_name->num_rows > 0 && $current_model_details["model_name"] != $model_name) {
  
    $res = array(
      "Error" => true,
      "Message" => "A model with that name already exists." 
    );

    echo json_encode($res);

    exit();

  } else {

    $update_query = "UPDATE model SET model_name = '$model_name', make_id = '$make_id' WHERE id = '$model_id'";

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
        "Message" => "Error updating the model information. Please try again." 
      );

      echo json_encode($res);
      
      exit();
    }
  
  }

}

if (isset($_POST["deletemodel"])) {
  
  $model_id = $db->real_escape_string($_POST["modelid"]);

  $query = "DELETE FROM model WHERE id = '$model_id'";

  $execute = $db->query($query);

  if ($execute) {

    $res = array(
      "Error" => false,
      "Message" => "Model deleted successfully." 
    );

    echo json_encode($res);
    
    exit();

  } else {

    $res = array(
      "Error" => true,
      "Message" => "Error deleting model." 
    );

    echo json_encode($res);
    
    exit();
  }
}

function get_car_models() {
	global $db;

	$sql = "SELECT model.id, model.model_name, model.make_id, make.make_name FROM model INNER JOIN make ON model.make_id = make.id";

	$results = $db->query($sql);

	return $results;
	exit();
		
}




?>