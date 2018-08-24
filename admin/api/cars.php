<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	include '../../config/db.php';
} else {
	include '../config/db.php';
}

if (isset($_POST["carAdd"])) {

	$hiring_price = $db->real_escape_string($_POST["hiringprice"]);
	$fuel_type = $db->real_escape_string($_POST["fueltype"]);
	$color = $db->real_escape_string($_POST["color"]);
	$link = $db->real_escape_string($_POST["link"]);
	$company_id = $db->real_escape_string($_POST["companyid"]);
	$car_image = $_FILES["carimage"];
	$car_type = $db->real_escape_string($_POST["cartype"]);
	$speed = $db->real_escape_string($_POST["speed"]);
	$description = $db->real_escape_string(trim($_POST["description"]));
	$model_id = $db->real_escape_string($_POST["modelid"]);
	$make_id = $db->real_escape_string($_POST["makeid"]);

	$image_upload_dir = "../../assets/images/";

	$image_upload_file = $image_upload_dir . $car_image["name"];

	// File Exists?
	if (file_exists($image_upload_file)) {

		$image_exists = true;

		// $res = array(
		// 	"Error" => true,
		// 	"Message" => "Image already exists." 
		// );

		// echo json_encode($res);

		// exit();

	}
		if (!$image_exists) {
			$is_image_uploaded = move_uploaded_file($car_image["tmp_name"], $image_upload_file);
		} else {
			$is_image_uploaded = true;
		}

		if (!$is_image_uploaded && !$image_exists) {

			$res = array(
				"Error" => true,
				"Message" => "Error adding car." 
			);

			echo json_encode($res);
			
			exit();

		} else {

			$image_name = $car_image["name"];

			$query = "INSERT INTO car_details (hiring_price, fuel_type, color, description, speed, make_id, model_id, company_id, link, image, new ) VALUES ('$hiring_price', '$fuel_type', '$color', '$description', '$speed', '$make_id', '$model_id', '$company_id', '$link', '$image_name', '$car_type')";

			$is_car_uploaded_to_database = $db->query($query);

			if ($is_car_uploaded_to_database) {

				$res = array(
					"Error" => false,
					"Message" => "Car added successfully." 
				);

				echo json_encode($res);
				
				exit();

			} else {

				$res = array(
					"Error" => true,
					"Message" => "Error adding car." 
				);

				echo json_encode($res);
				
				exit();

			}

		} 	

}

if (isset($_POST["carupdate"])) {

  $is_file_empty = empty($_FILES);

	$hiring_price = $db->real_escape_string($_POST["hiringprice"]);
	$fuel_type = $db->real_escape_string($_POST["fueltype"]);
	$color = $db->real_escape_string($_POST["color"]);
	$link = $db->real_escape_string($_POST["link"]);
	$company_id = $db->real_escape_string($_POST["companyid"]);
	$car_type = $db->real_escape_string($_POST["cartype"]);
	$speed = $db->real_escape_string($_POST["speed"]);
	$description = $db->real_escape_string(trim($_POST["description"]));
	$model_id = $db->real_escape_string($_POST["modelid"]);
	$make_id = $db->real_escape_string($_POST["makeid"]);
	$car_id = $db->real_escape_string($_POST["carid"]);


  $image_upload_dir = "../../assets/images/";
  
  if (!$is_file_empty) {

    $car_image = $_FILES["carimage"];
    
    $image_upload_file = $image_upload_dir . $car_image["name"];
    
  }


	// File Exists?
	if (!$is_file_empty && file_exists($image_upload_file)) {

		$image_exists = true;

	} else {

		$image_exists = false;

  }
		if (!$image_exists && !$is_file_empty) {

      $is_image_uploaded = move_uploaded_file($car_image["tmp_name"], $image_upload_file);
      
		} else {

      $is_image_uploaded = true;
      
		}

		if (!$is_image_uploaded && !$image_exists) {

			$res = array(
				"Error" => true,
				"Message" => "Error adding car." 
			);

			echo json_encode($res);
			
			exit();

		} else {

      
      if (!$is_file_empty) {

        $image_name = $car_image["name"];

        $query = "UPDATE car_details SET hiring_price = '$hiring_price', fuel_type = '$fuel_type', color = '$color', description = '$description', speed = '$speed', make_id = '$make_id', model_id = '$model_id', company_id = '$company_id', link = '$link', image = '$image_name', new = '$car_type'";
        
      } else {

        $query = "UPDATE car_details SET hiring_price = '$hiring_price', fuel_type = '$fuel_type', color = '$color', description = '$description', speed = '$speed', make_id = '$make_id', model_id = '$model_id', company_id = '$company_id', link = '$link', new = '$car_type'";

      }

      $query .= "WHERE id = '$car_id'";

			$is_car_updated_in_database = $db->query($query);

			if ($is_car_updated_in_database) {

				$res = array(
					"Error" => false,
					"Message" => "Car updated successfully." 
				);

				echo json_encode($res);
				
				exit();

			} else {

				$res = array(
					"Error" => true,
					"Message" => "Error adding car." 
				);

				echo json_encode($res);
				
				exit();

			}

		} 	

}

if (isset($_POST["deletecar"])) {
  
  $car_id = $db->real_escape_string($_POST["carid"]);

  $query = "DELETE FROM car_details WHERE id = '$car_id'";

  $execute = $db->query($query);

  if ($execute) {

    $res = array(
      "Error" => false,
      "Message" => "Car deleted successfully." 
    );

    echo json_encode($res);
    
    exit();

  } else {

    $res = array(
      "Error" => true,
      "Message" => "Error deleting car." 
    );

    echo json_encode($res);
    
    exit();
  }
}


function get_cars($companyid) {

	global $db;

	$sql = "SELECT 
						cd.*, 
						mo.model_name AS model, 
						ma.make_name AS make 
					FROM car_details cd 
					INNER JOIN model mo ON cd.model_id = mo.id 
					INNER JOIN make ma ON cd.make_id = ma.id
					WHERE cd.company_id = '$companyid'";

	$results = $db->query($sql);

	return $results;

	exit();
		
}


function get_all_cars() {

	global $db;

	$sql = "SELECT 
						cd.*, 
						mo.model_name AS model, 
						ma.make_name AS make,
            co.name AS company 
					FROM car_details cd 
					INNER JOIN model mo ON cd.model_id = mo.id 
          INNER JOIN make ma ON cd.make_id = ma.id
          INNER JOIN car_rental_company co ON cd.company_id = co.id";

	$results = $db->query($sql);

	return $results;

	exit();
		
}


?>