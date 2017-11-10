<?php

define("API_KEY", "39a9a13d56112cbbcbac8259ddc4ae46");
define("API_PASS", "!HDq36P+0-Si90f+VmwT5WFklJdTwIGu");

define("API_BASE", "https://api.inzu.net/");
define("API_VERSION", "1.5");


//Check API connection can be established or print error

$data = INZU_GET("general/account_live");


if ( $data->live_status != "true" ) {
	
	echo "Sorry the site is down at the moment.";
	exit();
	
}

?>