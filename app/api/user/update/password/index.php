<?php
	require_once __DIR__."/../../../../autoload.php";
	$userId = loginManager::getUserDetailFromAddress($_REQUEST["email"])["id"];

	$params = array(
		"email"=>$_REQUEST["email"], 
		"password"=>$_REQUEST["old_password"]
	);

	if(!loginManager::doLogin($params)){
		header('HTTP/1.0 401 Unauthorized');
		print("Unauthorized.2");
		exit();
	}

	loginManager::updateUserPassword($userId, $_REQUEST["new_password"]);

?>