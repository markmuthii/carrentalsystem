<?php  

include 'config/db.php';

function get_car_makes() {
	global $db;

	$sql = "SELECT * FROM make";

	$results = $db->query($sql);

	return $results;
	
	exit();
		
}
?>