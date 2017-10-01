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
  $paramsA = array(
    "id"=>$_REQUEST["elementA"],
    "user_id"=>$userId
  );

  $paramsB = array(
    "id"=>$_REQUEST["elementB"],
    "user_id"=>$userId
  );

  $elementA = $categoryManager->getCategories(
    "id = :id and user = :user",
    $paramsA
  )[0];

  $elementB = $categoryManager->getCategories(
    "id = :id and user = :user",
    $paramsB
  )[0];

  if(empty($elementA) || empty($elementB)){
    header('HTTP/1.0 401 Unauthorized');
    print("Unauthorized.");
    exit();
  }

  $resultA = $categoryManager->sortCategory(
    (int)$elementA["id"],
    (int)$elementB["sort"]
  );

  $resultB = $categoryManager->sortCategory(
    (int)$elementB["id"],
    (int)$elementA["sort"]
  );
  
  header("Content-Type: application/json; charset=utf-8");
  print(json_encode(array("result"=>($resultA && $resultB) )));