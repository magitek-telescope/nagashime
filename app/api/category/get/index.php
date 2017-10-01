<?php
require_once __DIR__."/../../../autoload.php";

$user = loginManager::getUserDetailFromAddress($_REQUEST["email"]);

$categoryManager = new categoryManager();
$feedManager     = new feedManager();

$getCategories = $categoryManager->getCategories(
	"user_id = :id", 
	array(
		"id"=>loginManager::getUserIdFromAddress($_REQUEST["email"])
	)
);

$categories = array();
foreach ($getCategories as $category) {
	$categories[$category["name"]]["id"] = $category["id"];
	$categories[$category["name"]]["sort"] = $category["sort"];
	$categories[$category["name"]]["feeds"] = array();

	$feeds = $feedManager->getFeeds(
		"category = :category and user_id = :user_id",
		array("category" => $category["id"], "user_id"=>$category["user_id"])
	);
	foreach ($feeds as $feed) {
		$categories[$category["name"]]["feeds"][] = $feed;
	}
}

header("Content-Type: application/json; charset=utf-8");
print(json_encode($categories));