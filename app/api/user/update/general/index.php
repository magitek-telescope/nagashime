<?php
	require_once __DIR__."/../../../../autoload.php";
	$userId = loginManager::getUserDetailFromAddress($_REQUEST["email"])["id"];
	$result = loginManager::updateUser($userId, $_REQUEST);
	header("Content-Type: application/json; charset=utf-8");
	print(json_encode(array("result"=>$result)));
?>