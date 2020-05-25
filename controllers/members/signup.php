<?php
	//libs
	include_once __DIR__."./../../libs/c_lib_global.php";

	$c_lib_global = new C_lib_global();

	$res_json = array();

	$res = $c_lib_global->get_c_regex()->signup_form_check($post_vars);

	if ($res != $c_lib_global->get_c_error()::SUCCESS_) {
		$ret = array("errorCode" => $res, "msg" => $c_lib_global->get_c_error()::ERR_MSG[$res]);
		echo json_encode($ret);
	} else {
		$res = $c_lib_global->get_c_db_mysql()->insert_member($post_vars);
		$c_lib_global->get_c_db_mysql()->close_conn();

		$ret = array("errorCode" => $res, "msg" => $c_lib_global->get_c_error()::ERR_MSG[$res]);
		echo json_encode($ret);
	}
?>