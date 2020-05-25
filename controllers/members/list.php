<?php
	//libs
	include_once __DIR__."./../../libs/c_lib_global.php";

	$c_lib_global = new C_lib_global();

	echo "/controllers/members/list.php";
	print_r($_GET);

	$order_num = $c_lib_global->get_c_random()->gen_order_num();

	echo $order_num;
?>