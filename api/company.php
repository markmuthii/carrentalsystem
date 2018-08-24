<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	include '../config/db.php';

} else {

	include 'config/db.php';

}

function get_companies() {

  global $db;

  $sql = "SELECT * FROM car_rental_company";

  $results = $db->query($sql);

  return $results;

  exit();
    
}

function get_company_contact_about() {

	global $db;
  
	$sql = "SELECT * FROM company";
  
	$results = $db->query($sql);
	
	$results = $results->fetch_array();
  
	return $results;
	  
	exit();
  }

?>