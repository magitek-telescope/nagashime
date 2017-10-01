<?php
/**
 * /category/update/
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
    "id = :id and user = :user",
    $params
  )[0];

  if(empty($getCategory)){
    header('HTTP/1.0 401 Unauthorized');
    print("Unauthorized.");
    exit();
  }

  $result = $categoryManager->renameCategory(
    (int)$getCategory["id"],
    $_REQUEST["name"]
  );
  
  header("Content-Type: application/json; charset=utf-8");
  print(json_encode(array("result"=>$result)));