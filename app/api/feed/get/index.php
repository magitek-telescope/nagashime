<?php
/**
 * /feed/get/
 *
 * 特定のカテゴリのfeedsを取得
**/
	require_once __DIR__."/../../../autoload.php";
	$userId = loginManager::getUserDetailFromAddress($_REQUEST["email"])["id"];

	$categoryManager = new categoryManager();
	$feedManager     = new feedManager();
	$params = array(
		"id"=>$_REQUEST["id"],
		"user_id"=>$userId
	);

	$getCategory = $categoryManager->getCategories(
		"id = :id and user_id = :user_id",
		$params
	)[0];

	if(empty($getCategory)){
		header('HTTP/1.0 401 Unauthorized');
		print("Unauthorized.");
		exit();
	}

	$category = array();
	$category["id"]    = $getCategory["id"];
	$category["feeds"] = array();

	$feeds = $feedManager->getFeeds(
		"category = :category and user_id = :user_id",
		array("category" => $getCategory["id"], "user_id"=>$userId)
	);
	foreach ($feeds as $feed) {
		$category["feeds"][] = $feed;
	}
	
	header("Content-Type: application/json; charset=utf-8");
	print(json_encode($category));