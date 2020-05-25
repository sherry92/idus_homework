<?php
	// class router
	include 'router.php';

	// Define controllers base directory
	define('MEMBER_CONTROLLER_BASE_PATH', __DIR__.'/controllers/members');

	C_router::add('/', function() {
		echo "Welcome :-)<br>";
	});

	// sign up
	C_router::add('/members', function() {
		$post_vars = json_decode(file_get_contents("php://input"), true);
		require_once(MEMBER_CONTROLLER_BASE_PATH.'/signup.php');
	}, 'post');

	// log in or logout
	C_router::add('/members/([^/]+)', function() {
		echo "/members/.../login or logout<br>";
		$put_vars = json_decode(file_get_contents("php://input"), true);
		
		if (array_key_exists('passwd', $put_vars)) {
			require_once(MEMBER_CONTROLLER_BASE_PATH.'/login.php');
		} else if (array_key_exists('session_id', $put_vars)) {
			require_once(MEMBER_CONTROLLER_BASE_PATH.'/logout.php');
		}
	}, 'put');

	// // member profile
	C_router::add('/members/([^/]+)', function() {
		echo "member profile";
		require_once(MEMBER_CONTROLLER_BASE_PATH.'/profile.php');
	}, 'get');

	// member order list
	C_router::add('/members/([^/]+)/orders', function() {
		echo "/members/.../orders";
		require_once(MEMBER_CONTROLLER_BASE_PATH.'/orders.php');
	}, 'get');

	// members list 
	C_router::add('/members', function() {
		echo "members/list";
		require_once(MEMBER_CONTROLLER_BASE_PATH.'/list.php');
	}, 'get');

	C_router::run('/');
?>