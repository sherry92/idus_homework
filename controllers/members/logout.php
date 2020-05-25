<?php
	//libs
	include_once __DIR__."./../../libs/c_lib_global.php";

	$c_lib_global = new C_lib_global();

	echo "/controllers/members/logout.php";
	print_r($put_vars);

	$uri_arr = explode('/', parse_url($_SERVER['REQUEST_URI'])['path']);
	$uni_member_id = $uri_arr[2];
	print_r($uri_arr);
	print_r($uni_member_id);
?>