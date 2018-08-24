<?php

include 'config/db.php';

function get_car_models() {
	global $db;

	$sql = "SELECT model.id, model.model_name, model.make_id, make.make_name FROM model INNER JOIN make ON model.make_id = make.id";

	$results = $db->query($sql);

	return $results;
	exit();
		
}

?>