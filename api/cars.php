<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  include '../config/db.php';
  
} else {

  include 'config/db.php';
  
}

if (isset($_POST["searchcar"])) {
  $modelid = $db->real_escape_string($_POST["modelid"]);
  $min = $db->real_escape_string($_POST["min"]);
  $max = $db->real_escape_string($_POST["max"]);
  $new = $db->real_escape_string($_POST["new"]);

  $min = (int)$min - 1;
  $max = (int)$max + 1;
  
  $query = "SELECT 
              cd.*, 
              mo.model_name AS model, 
              ma.make_name AS make 
            FROM car_details cd 
            INNER JOIN model mo ON cd.model_id = mo.id 
            INNER JOIN make ma ON cd.make_id = ma.id
            WHERE cd.model_id = '$modelid'
            AND cd.new = '$new'
            AND CAST(cd.hiring_price AS UNSIGNED) > '$min' 
            AND CAST(cd.hiring_price AS UNSIGNED) < '$max'";

  $results = $db->query($query);

  $cars = array();

  while ($car = $results->fetch_assoc()) {
    $cars[] = $car;
  }

  echo json_encode($cars);
}


function get_all_cars() {

	global $db;

	$sql = "SELECT 
						cd.*, 
						mo.model_name AS model, 
						ma.make_name AS make 
					FROM car_details cd 
					INNER JOIN model mo ON cd.model_id = mo.id 
					INNER JOIN make ma ON cd.make_id = ma.id";

	$results = $db->query($sql);

	return $results;

	exit();
		
}

function get_limits() {
  global $db;

  $sql = "SELECT MIN(hiring_price) AS min, MAX(hiring_price) AS max FROM car_details";

  $results = $db->query($sql);

  $limits = array();

  while ($limit = $results->fetch_assoc()) {
    $limits[] = $limit;
  }

  return $limits;

  exit();
}