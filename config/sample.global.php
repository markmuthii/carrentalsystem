<?php  

if (!empty($_SERVER["SCRIPT_FILENAME"]) && "global.php" == basename($_SERVER["SCRIPT_FILENAME"])) {
	header("Location: ../");
	exit();
}

define("BASE_URL", "http://localhost/carrentalweb/"); // absolute path to project root folder

define("FACEBOOK_URL", "https://facebook.com/");

define("TWITTER_URL", "https://twitter.com/");

define("INSTAGRAM_URL", "https://instagram.com/");

define("GOOGLE_PLUS_URL", "https://plus.google.com/");

define("EMAIL_URL", "mailto:");

define("TEL_URL", "tel:");

define("IMAGE_DIRECTORY", BASE_URL . "assets/images/");

define("DB_SERVER", ""); // server eg localhost

define("DB_USER", ""); // database user eg root

define("DB_PASS", ""); // password for user defined above

define("DB_NAME", ""); // database name

?>