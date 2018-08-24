<?php  

if (!empty($_SERVER["SCRIPT_FILENAME"]) && "db.php" == basename($_SERVER["SCRIPT_FILENAME"])) {
	header("Location: ../");
	exit();
}

require_once "global.php";

$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

?>